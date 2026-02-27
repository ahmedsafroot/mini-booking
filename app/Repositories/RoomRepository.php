<?php

namespace App\Repositories;

use App\Models\Room;
use Illuminate\Pagination\LengthAwarePaginator;

class RoomRepository
{
    public function list(int $perPage = 10): LengthAwarePaginator
    {
        return Room::with('hotel')->paginate($perPage);
    }

    public function create(array $data): Room
    {
        return Room::create($data);
    }

    public function find(int $id): Room
    {
        return Room::findOrFail($id);
    }

    public function delete(int $id): void
    {
        Room::findOrFail($id)->delete();
    }
}
