<?php

namespace App\Services;

use App\Models\Room;
use App\Repositories\RoomRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class RoomService
{
    public function __construct(protected RoomRepository $roomRepository)
    {
    }
    public function list(): LengthAwarePaginator
    {
        return $this->roomRepository->list();
    }

    public function create(array $data): Room
    {
        return $this->roomRepository->create($data);
    }

    public function delete($id): void
    {
        $this->roomRepository->delete($id);
    }
}
