<?php

namespace App\Services;

use App\Models\Hotel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class SearchService
{
    public function search(array $data)
    {
        $cacheKey = 'search_' . md5(json_encode($data));

        return Cache::remember($cacheKey, now()->addMinutes(5), function () use ($data) {

            $nights = Carbon::parse($data['checkin_date'])
                ->diffInDays($data['checkout_date']);

            $hotels = Hotel::where('city', $data['city'])
                ->whereHas('rooms', function ($q) use ($data) {
                    $q->where('max_occupancy', '>=', $data['guests'])
                        ->where('available_rooms', '>', 0);
                })
                ->with(['rooms' => function ($q) use ($data) {
                    $q->where('max_occupancy', '>=', $data['guests'])
                        ->where('available_rooms', '>', 0);
                }])
                ->get();

            return $hotels->map(function ($hotel) use ($nights) {
                $hotel->rooms->map(function ($room) use ($nights) {
                    $room->total_price = $room->price_per_night * $nights;
                    return $room;
                });
                return $hotel;
            });
        });
    }
}
