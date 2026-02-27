@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between mb-3">
        <h3>Rooms</h3>
        <a href="{{ route('rooms.create') }}" class="btn btn-primary">Add Room</a>
    </div>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Hotel</th>
            <th>Name</th>
            <th>Price</th>
            <th>Max Occupancy</th>
            <th>Available</th>
            <th width="120">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($rooms as $room)
            <tr>
                <td>{{ $room->hotel->name }}</td>
                <td>{{ $room->name }}</td>
                <td>${{ $room->price_per_night }}</td>
                <td>{{ $room->max_occupancy }}</td>
                <td>{{ $room->available_rooms }}</td>
                <td>
                    <form method="POST"
                          action="{{ route('rooms.destroy',$room->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Delete room?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">No rooms found</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{ $rooms->links() }}

@endsection
