<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venue;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    // Show the booking form
    public function create()
    {
        $venues = Venue::where('available', true)->get();
        return view('reservations.create', compact('venues'));
    }

    // Store the booking in the database
    public function store(Request $request)
    {
        $request->validate([
            'venueID' => 'required',
            'date' => 'required|date',
            'startTime' => 'required',
            'endTime' => 'required',
        ]);

        $reservation = new Reservation();
        $reservation->reservationID = 'RES-' . strtoupper(uniqid()); // Generate unique ID
        $reservation->date = $request->date;
        $reservation->startTime = $request->startTime;
        $reservation->endTime = $request->endTime;
        $reservation->status = 'Pending';
        $reservation->venueID = $request->venueID;
        $reservation->userID = Auth::user()->userID;
        $reservation->save();

        return redirect('/dashboard')->with('success', 'Reservation submitted!');
    }
}