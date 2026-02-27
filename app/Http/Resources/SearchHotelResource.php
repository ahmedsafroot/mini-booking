<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchHotelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'hotel_id' => $this->id,
            'hotel_name' => $this->name,
            'city' => $this->city,
            'rating' => $this->rating,
            'rooms' => $this->rooms->map(function ($room) {
                return [
                    'room_id' => $room->id,
                    'name' => $room->name,
                    'price_per_night' => $room->price_per_night,
                    'total_price' => $room->total_price,
                ];
            })
        ];
    }
}
