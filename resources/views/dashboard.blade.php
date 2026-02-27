@extends('layouts.app')

@section('content')

    <h2 class="mb-4">Dashboard</h2>

    <div class="row">

        <!-- Total Hotels -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Total Hotels</h5>
                    <h2 class="fw-bold text-primary">
                        {{ $totalHotels }}
                    </h2>
                </div>
            </div>
        </div>

        <!-- Total Rooms -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Total Rooms</h5>
                    <h2 class="fw-bold text-success">
                        {{ $totalRooms }}
                    </h2>
                </div>
            </div>
        </div>

    </div>

    <hr class="my-4">

    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('hotels.index') }}" class="btn btn-outline-primary w-100">
                Manage Hotels
            </a>
        </div>

        <div class="col-md-3">
            <a href="{{ route('rooms.index') }}" class="btn btn-outline-success w-100">
                Manage Rooms
            </a>
        </div>

        <div class="col-md-3">
            <a href="{{ route('search.index') }}" class="btn btn-outline-dark w-100">
                Search
            </a>
        </div>
    </div>

@endsection
