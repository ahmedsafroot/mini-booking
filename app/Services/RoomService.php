<?php

namespace App\Services;

use App\Models\Room;
use Illuminate\Pagination\LengthAwarePaginator;

class RoomService
{
    public function list(): LengthAwarePaginator
    {
        return Room::with('hotel')->paginate(10);
    }

    public function create(array $data): Room
    {
        return Room::create($data);
    }

    public function delete($id): void
    {
        Room::findOrFail($id)->delete();
    }
}
