<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Services\SearchService;
use Illuminate\Contracts\View\View;

class SearchController extends Controller
{
    public function __construct(
        protected SearchService $searchService
    ) {}

    public function index(): View
    {
        return view('search.index');
    }

    public function search(SearchRequest $request): View
    {
        $filters = $request->validated();
        $results = $this->searchService->search($filters);

        return view('search.index', compact('results', 'filters'));    }
}
