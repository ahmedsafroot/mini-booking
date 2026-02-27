<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Resources\RoomResource;
use App\Services\RoomService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class RoomController extends Controller
{
    use ApiResponseTrait;
    public function __construct(
        protected RoomService $roomService
    ) {}

    public function store(StoreRoomRequest $request): JsonResponse
    {
        $room = $this->roomService->create($request->validated());
        return $this->respondWithResource(new RoomResource($room),'Room created successfully',201);
    }
}
