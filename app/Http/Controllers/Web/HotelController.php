<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\StoreHotelRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Services\HotelService;

class HotelController extends Controller
{
    public function __construct(
        protected HotelService $hotelService
    ) {}

    public function index(Request $request): View
    {
        $filters = $request->only('city');

        $hotels = $this->hotelService->list($filters);

        return view('hotels.index', compact('hotels'));
    }

    public function create(): View
    {
        return view('hotels.create');
    }

    public function store(StoreHotelRequest $request): RedirectResponse
    {
        $this->hotelService->create($request->validated());

        return redirect()
            ->route('hotels.index')
            ->with('success', 'Hotel created successfully');
    }

    public function edit($id): View
    {
        $hotel = $this->hotelService->find($id);

        return view('hotels.edit', compact('hotel'));
    }

    public function update(StoreHotelRequest $request, $id): RedirectResponse
    {
        $this->hotelService->update($id, $request->validated());

        return redirect()
            ->route('hotels.index')
            ->with('success', 'Hotel updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        $this->hotelService->delete($id);

        return back()->with('success', 'Hotel deleted successfully');
    }
}
