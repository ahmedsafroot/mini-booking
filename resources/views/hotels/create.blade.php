@extends('layouts.app')

@section('content')

    <h3>Add Hotel</h3>

    <form method="POST" action="{{ route('hotels.store') }}">
        @csrf

        @include('hotels.partials.form')

        <button class="btn btn-success mt-3">Create</button>

    </form>

@endsection
