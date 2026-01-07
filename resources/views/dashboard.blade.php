@extends('layouts.app')

@section('content')
    <div class="bg-white p-6 rounded shadow">
        @auth
            <h1>Welcome, {{ $user->name }}</h1>
            <a href="{{ route('reservations.create') }}">Book a Venue</a>

            <h2>Your Reservations</h2>
            <ul>
                @foreach($reservations as $res)
                    <li>{{ $res->date }} - {{ $res->venue->name }} ({{ $res->status }})</li>
                @endforeach
            </ul>
        @endauth
    </div>
    
@endsection