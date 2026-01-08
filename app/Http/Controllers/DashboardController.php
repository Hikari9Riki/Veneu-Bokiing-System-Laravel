<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Get the currently logged-in user
        
        // Fetch reservations belonging to this user
        $reservations = Reservation::where('id', $user->id)
                                   ->with('venue') // Eager load venue names
                                   ->get();

        return view('dashboard', compact('user', 'reservations'));
    }
}