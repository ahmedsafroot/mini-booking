<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoomRequest;
use App\Models\Hotel;
use App\Services\RoomService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class RoomController extends Controller
{
    public function __construct(
        protected RoomService $roomService
    ) {}

    public function index(): View
    {
        $rooms = $this->roomService->list();

        return view('rooms.index', compact('rooms'));
    }

    public function create(): View
    {
        $hotels = Hotel::select('id','name')->get();

        return view('rooms.create', compact('hotels'));
    }

    public function store(StoreRoomRequest $request): RedirectResponse
    {
        $this->roomService->create($request->validated());

        return redirect()
            ->route('rooms.index')
            ->with('success', 'Room created successfully');
    }

    public function destroy($id): RedirectResponse
    {
        $this->roomService->delete($id);

        return back()->with('success', 'Room deleted successfully');
    }
}
