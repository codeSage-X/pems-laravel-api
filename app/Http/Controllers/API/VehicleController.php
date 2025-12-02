<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Get all vehicles with filters
     */
    public function index(Request $request)
    {
        $query = Vehicle::query();

        // Filter by type
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by low fuel (<30%)
        if ($request->has('low_fuel')) {
            $query->where('fuel_level', '<', 30);
        }

        // Search by name or license plate
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'ILIKE', "%{$search}%")
                  ->orWhere('license_plate', 'ILIKE', "%{$search}%");
            });
        }

        $vehicles = $query->paginate($request->get('per_page', 10));

        return response()->json([
            'status' => 'success',
            'data' => $vehicles,
        ]);
    }

    /**
     * Create new vehicle
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:CARGO_TRUCK,VAN,CAR,PICKUP',
            'license_plate' => 'required|string|unique:vehicles,license_plate',
            'fuel_level' => 'nullable|integer|min:0|max:100',
            'mileage' => 'nullable|integer|min:0',
            'status' => 'nullable|in:AVAILABLE,IN_TRANSIT,MAINTENANCE,OUT_OF_SERVICE',
            'last_inspection' => 'nullable|date',
            'next_inspection' => 'nullable|date',
        ]);

        $vehicle = Vehicle::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Vehicle created successfully',
            'data' => $vehicle,
        ], 201);
    }

    /**
     * Get single vehicle
     */
    public function show($id)
    {
        $vehicle = Vehicle::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $vehicle,
        ]);
    }

    /**
     * Update vehicle
     */
    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'type' => 'sometimes|in:CARGO_TRUCK,VAN,CAR,PICKUP',
            'license_plate' => 'sometimes|string|unique:vehicles,license_plate,' . $id,
            'fuel_level' => 'nullable|integer|min:0|max:100',
            'mileage' => 'nullable|integer|min:0',
            'status' => 'sometimes|in:AVAILABLE,IN_TRANSIT,MAINTENANCE,OUT_OF_SERVICE',
            'last_inspection' => 'nullable|date',
            'next_inspection' => 'nullable|date',
        ]);

        $vehicle->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Vehicle updated successfully',
            'data' => $vehicle,
        ]);
    }

    /**
     * Delete vehicle
     */
    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Vehicle deleted successfully',
        ]);
    }
}