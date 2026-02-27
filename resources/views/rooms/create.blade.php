@extends('layouts.app')

@section('content')

    <h3>Add Room</h3>

    <form method="POST" action="{{ route('rooms.store') }}">
        @csrf

        <div class="mb-3">
            <label>Hotel</label>
            <select name="hotel_id" class="form-control">
                <option value="">Select Hotel</option>
                @foreach($hotels as $hotel)
                    <option value="{{ $hotel->id }}">
                        {{ $hotel->name }}
                    </option>
                @endforeach
            </select>
            @error('hotel_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label>Room Name</label>
            <input type="text" name="name" class="form-control">
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label>Price Per Night</label>
            <input type="number" step="0.01"
                   name="price_per_night" class="form-control">
            @error('price_per_night')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label>Max Occupancy</label>
            <input type="number" name="max_occupancy"
                   class="form-control">
            @error('password')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label>Available Rooms</label>
            <input type="number" name="available_rooms"
                   class="form-control">
            @error('available_rooms')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button class="btn btn-success">Create</button>

    </form>

@endsection
