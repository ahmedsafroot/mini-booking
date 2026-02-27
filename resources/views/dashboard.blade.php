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


@endsection
