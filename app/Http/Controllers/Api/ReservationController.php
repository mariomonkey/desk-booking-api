<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function index(Request $request)
{
    // Fetch reservations for the logged-in user, ordered by date
    // 'with('desk')' eager loads the desk details so we can show its name!
    $reservations = $request->user()->reservations()->with('desk')->orderBy('date', 'asc')->get();
    
    return response()->json($reservations, 200);
}
    public function store(Request $request)
    {
        // 1. Validate the incoming data from React
        $request->validate([
            'desk_id' => 'required|exists:desks,id',
            'date' => 'required|date',
        ]);

        // 2. Check if the desk is already booked on that date
        $isBooked = Reservation::where('desk_id', $request->desk_id)
            ->where('date', $request->date)
            ->exists();

        if ($isBooked) {
            return response()->json(['message' => 'Desk is already booked for this date.'], 422);
        }

        // 3. Create the reservation attached to the logged-in user
        $reservation = $request->user()->reservations()->create([
            'desk_id' => $request->desk_id,
            'date' => $request->date,
            'status' => 'confirmed'
        ]);

        return response()->json($reservation, 201);
    }
    public function destroy(Request $request, $id)
    {
    // Find the reservation ONLY if it belongs to the logged-in user
    $reservation = $request->user()->reservations()->findOrFail($id);
    
    // Delete it from the database
    $reservation->delete();
    
    // Return a success response
    return response()->json(['message' => 'Reservation cancelled successfully'], 200);
    }   
}