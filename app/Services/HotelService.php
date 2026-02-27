<?php

namespace App\Services;

use App\Models\Hotel;
use App\Repositories\HotelRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class HotelService
{
    public function __construct(protected HotelRepository $hotelRepository)
    {
    }

    public function list(array $filters): LengthAwarePaginator
    {
        return $this->hotelRepository->list($filters);
    }

    public function create(array $data): Hotel
    {
        return $this->hotelRepository->create($data);
    }

    public function find($id): Hotel
    {
        return $this->hotelRepository->find($id);
    }

    public function update($id, array $data): void
    {
        $this->hotelRepository->update($id,$data);
    }

    public function delete($id): void
    {
        $this->hotelRepository->delete($id);
    }
}
