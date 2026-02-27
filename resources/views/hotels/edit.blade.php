@extends('layouts.app')

@section('content')

    <h3>Edit Hotel</h3>

    <form method="POST" action="{{ route('hotels.update',$hotel->id) }}">
        @csrf
        @method('PUT')

        @include('hotels.partials.form')

        <button class="btn btn-primary mt-3">Update</button>

    </form>

@endsection
