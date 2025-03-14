<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parking;
use App\Models\Reservation;

class ParkingController extends Controller
{
    // List all parkings
    public function index()
    {
        $parkings = Parking::all();
        return response()->json($parkings);
    }

    //crude
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'location' => 'required|string',
        'total_spaces' => 'required|integer',
        'available_spaces' => 'required|integer',
    ]);

    $parking = Parking::create($request->all());
    return response()->json($parking, 201);
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'sometimes|string|max:255',
        'location' => 'sometimes|string',
        'total_spaces' => 'sometimes|integer',
        'available_spaces' => 'sometimes|integer',
    ]);

    $parking = Parking::findOrFail($id);
    $parking->update($request->all());
    return response()->json($parking);
}

public function destroy($id)
{
    $parking = Parking::findOrFail($id);
    $parking->delete();
    return response()->json(null, 204);
}

public function search(Request $request)
{
    $request->validate([
        'name' => 'nullable|string',
        'available' => 'nullable|boolean',
    ]);

    $query = Parking::query();

    // name filter
    if ($request->has('name')) {
        $query->where('name', 'like', '%' . $request->name . '%');
    }

    // availability filter
    if ($request->has('location')) {
        $query->where('location', 'like', '%' . $request->location . '%');
    }
&
    $parkings = $query->get();
    return response()->json($parkings);
}
public function statistics()
{
    $totalParkings = Parking::count();

    $totalReservations = Reservation::count();

    $totalSpaces = Parking::sum('total_spaces');
    $occupiedSpaces = $totalSpaces - Parking::sum('available_spaces');
    $occupancyRate = ($totalSpaces > 0) ? ($occupiedSpaces / $totalSpaces) * 100 : 0;

    return response()->json([
        'total_parkings' => $totalParkings,
        'total_reservations' => $totalReservations,
        'occupancy_rate' => round($occupancyRate, 2),
    ]);
}
}
