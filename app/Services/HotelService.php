<?php

namespace App\Services;

use App\Models\Hotel;
use Illuminate\Pagination\LengthAwarePaginator;

class HotelService
{
    public function list(array $filters): LengthAwarePaginator
    {
        $query = Hotel::query();

        if (!empty($filters['city'])) {
            $query->where('city', $filters['city']);
        }

        return $query->paginate(10);
    }

    public function create(array $data): Hotel
    {
        return Hotel::create($data);
    }

    public function find($id): Hotel
    {
        return Hotel::findOrFail($id);
    }

    public function update($id, array $data): void
    {
        $hotel = $this->find($id);
        $hotel->update($data);
    }

    public function delete($id): bool
    {
        Hotel::findOrFail($id)->delete();
    }
}
