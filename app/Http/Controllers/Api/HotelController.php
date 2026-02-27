<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHotelRequest;
use App\Http\Resources\HotelResource;
use App\Services\HotelService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    use ApiResponseTrait;

    public function __construct(
        protected HotelService $hotelService
    ) {}

    public function store(StoreHotelRequest $request): JsonResponse
    {
        $hotel = $this->hotelService->create($request->validated());

        return $this->respondWithResource(new HotelResource($hotel),'Hotel created successfully',201);
    }

    public function index(Request $request): JsonResponse
    {
        $filters = $request->only(['city', 'rating']);

        $hotels = $this->hotelService->list($filters);

        return $this->respondWithResourceCollection(HotelResource::collection($hotels));
    }
}
