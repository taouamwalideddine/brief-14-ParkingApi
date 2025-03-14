<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Parking;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $reservations = $request->user()->reservations()->with('parking')->get();
        return response()->json($reservations);
    }

    public function store(Request $request)
    {
        $request->validate([
            'parking_id' => 'required|exists:parkings,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        $parking = Parking::findOrFail($request->parking_id);
        if ($parking->available_spaces <= 0) {
            return response()->json(['message' => 'No available spaces'], 400);
        }

        $reservation = Reservation::create([
            'user_id' => $request->user()->id,
            'parking_id' => $request->parking_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => 'active',
        ]);

        $parking->decrement('available_spaces');

        return response()->json($reservation, 201);
    }

    public function show($id)
    {
        $reservation = Reservation::findOrFail($id);

        if ($reservation->user_id !== Auth::user()->id) {
            return response()->json(['message' => 'Forbidden. You do not have permission to access this reservation.'], 403);
        }
        return response()->json($reservation);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'start_time' => 'sometimes|date',
            'end_time' => 'sometimes|date|after:start_time',
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->update($request->all());
        return response()->json($reservation);
    }

    public function destroy($id)
    {
        $reservation = Reservation::where('user_id', auth()->id())->findOrFail($id);

        $reservation->parking->increment('available_spaces');

        $reservation->delete();

        return response()->json(null, 204);
    }
}
