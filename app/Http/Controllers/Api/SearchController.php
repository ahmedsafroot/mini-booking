<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\SearchHotelResource;
use App\Services\SearchService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class SearchController extends Controller
{
    use ApiResponseTrait;
    public function __construct(
        protected SearchService $searchService
    ) {}

    public function search(SearchRequest $request): JsonResponse
    {
        $results = $this->searchService->search($request->validated());
        return $this->respondWithResourceCollection(SearchHotelResource::collection($results));
    }
}
