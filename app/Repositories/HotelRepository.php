<?php

namespace App\Repositories;

use App\Models\Hotel;
use Illuminate\Pagination\LengthAwarePaginator;

class HotelRepository
{
    public function list(array $filters, int $perPage = 10): LengthAwarePaginator
    {
        $query = Hotel::query();

        if (!empty($filters['city'])) {
            $query->where('city', $filters['city']);
        }

        if (!empty($filters['rating'])) {
            $query->where('rating', $filters['rating']);
        }

        return $query->paginate($perPage);
    }

    public function create(array $data): Hotel
    {
        return Hotel::create($data);
    }

    public function update($id, array $data): void
    {
        $hotel = $this->find($id);
        $hotel->update($data);
    }

    public function find(int $id): Hotel
    {
        return Hotel::findOrFail($id);
    }

    public function delete(int $id): void
    {
        Hotel::findOrFail($id)->delete();
    }
}
