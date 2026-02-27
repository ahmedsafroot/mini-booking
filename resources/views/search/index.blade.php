@extends('layouts.app')

@section('content')

    <h3>Search Availability</h3>

    <form method="POST" action="{{ route('search.perform') }}" class="row mb-4">
        @csrf

        <div class="col-md-3">
            <input type="text" name="city"
                   class="form-control"
                   placeholder="City"
                   value="{{ $filters['city'] ?? old('city') ?? '' }}">
            @error('city')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-2">
            <input type="date" name="checkin_date"
                   class="form-control"
                   value="{{ $filters['checkin_date'] ?? old('checkin_date') ?? '' }}">
            @error('checkin_date')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-2">
            <input type="date" name="checkout_date"
                   class="form-control"
                   value="{{ $filters['checkout_date'] ?? old('checkout_date') ?? '' }}">
            @error('checkout_date')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-2">
            <input type="number" name="guests"
                   class="form-control"
                   placeholder="Guests"
                   value="{{ $filters['guests'] ?? old('guests') ?? '' }}">
            @error('guests')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-2">
            <button class="btn btn-primary">Search</button>
        </div>

    </form>

    {{-- Results --}}
    @if(isset($results) && count($results))

        @foreach($results as $hotel)

            <div class="card mb-3">
                <div class="card-body">
                    <h5>{{ $hotel->name }} ({{ $hotel->rating }}★)</h5>
                    <p>{{ $hotel->city }}</p>

                    <table class="table">
                        <thead>
                        <tr>
                            <th>Room</th>
                            <th>Price/Night</th>
                            <th>Total Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($hotel->rooms as $room)
                            <tr>
                                <td>{{ $room->name }}</td>
                                <td>${{ $room->price_per_night }}</td>
                                <td>
                                    <strong>
                                        ${{ $room->total_price }}
                                    </strong>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        @endforeach

    @elseif(isset($results))
        <div class="alert alert-warning">
            No available hotels found.
        </div>
    @endif

@endsection
