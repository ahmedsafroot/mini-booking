@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h3>Hotels</h3>
    <a href="{{ route('hotels.create') }}" class="btn btn-primary">Add Hotel</a>
</div>

<!-- Filter -->
<form method="GET" action="{{ route('hotels.index') }}" class="row mb-3">
    <div class="col-md-4">
        <input type="text" name="city" class="form-control"
               placeholder="Filter by city"
               value="{{ request('city') }}">
    </div>
    <div class="col-md-2">
        <button class="btn btn-outline-secondary">Filter</button>
    </div>
</form>

<table class="table table-bordered">
    <thead>
    <tr>
        <th>Name</th>
        <th>City</th>
        <th>Country</th>
        <th>Rating</th>
        <th width="180">Actions</th>
    </tr>
    </thead>
    <tbody>
    @forelse($hotels as $hotel)
    <tr>
        <td>{{ $hotel->name }}</td>
        <td>{{ $hotel->city }}</td>
        <td>{{ $hotel->country }}</td>
        <td>{{ $hotel->rating }}</td>
        <td>
            <a href="{{ route('hotels.edit',$hotel->id) }}"
               class="btn btn-sm btn-warning">Edit</a>

            <form method="POST"
                  action="{{ route('hotels.destroy',$hotel->id) }}"
                  class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger"
                        onclick="return confirm('Delete hotel?')">
                    Delete
                </button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="5" class="text-center">No hotels found</td>
    </tr>
    @endforelse
    </tbody>
</table>

{{ $hotels->withQueryString()->links() }}

@endsection
