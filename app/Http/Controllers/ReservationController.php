<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venue;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

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
        $reservation->id = Auth::user()->id;
        $reservation->save();

        return redirect('/dashboard')->with('success', 'Reservation submitted!');
    }

    // Add this at the top with other imports


    // Add this new method inside your class ReservationController
    public function getReservations(Request $request): JsonResponse
    {
        $query = Reservation::query();

        // 1. Filter by Venue if selected
        if ($request->has('venue_id') && $request->venue_id != '') {
            $query->where('venueID', $request->venue_id);
        }

        // 2. Get reservations (only approved ones? Optional)
        // $query->where('status', 'Approved'); 
        $events = $query->get();

        // 3. Format for FullCalendar
        $formattedEvents = $events->map(function ($reservation) {
            return [
                'id'    => $reservation->reservationID,
                'title' => 'Booked', // Or show User Name if admin
                // Combine Date + Time for FullCalendar (ISO 8601)
                'start' => $reservation->date . 'T' . $reservation->startTime,
                'end'   => $reservation->date . 'T' . $reservation->endTime,
                'color' => '#dc3545', // Red color for booked slots
            ];
        });

        return response()->json($formattedEvents);
    }
}