<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * Get all equipment with filters
     */
    public function index(Request $request)
    {
        $query = Equipment::query();

        // Filter by type
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by location
        if ($request->has('location')) {
            $query->where('location', 'ILIKE', "%{$request->location}%");
        }

        // Search by name or serial number
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'ILIKE', "%{$search}%")
                  ->orWhere('serial_number', 'ILIKE', "%{$search}%");
            });
        }

        // Filter by maintenance due
        if ($request->has('maintenance_due')) {
            $query->whereNotNull('next_maintenance')
                  ->whereDate('next_maintenance', '<=', now()->addDays(30));
        }

        $equipment = $query->paginate($request->get('per_page', 10));

        return response()->json([
            'status' => 'success',
            'data' => $equipment,
        ]);
    }

    /**
     * Create new equipment
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:COMPRESSOR,PUMP,GAUGE,SEAL_KIT,CLEANER,TOOLS,OTHER',
            'serial_number' => 'required|string|unique:equipment,serial_number',
            'location' => 'nullable|string',
            'status' => 'nullable|in:OPERATIONAL,MAINTENANCE,OUT_OF_SERVICE,RETIRED',
            'last_maintenance' => 'nullable|date',
            'next_maintenance' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $equipment = Equipment::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Equipment created successfully',
            'data' => $equipment,
        ], 201);
    }

    /**
     * Get single equipment
     */
    public function show($id)
    {
        $equipment = Equipment::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $equipment,
        ]);
    }

    /**
     * Update equipment
     */
    public function update(Request $request, $id)
    {
        $equipment = Equipment::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'type' => 'sometimes|in:COMPRESSOR,PUMP,GAUGE,SEAL_KIT,CLEANER,TOOLS,OTHER',
            'serial_number' => 'sometimes|string|unique:equipment,serial_number,' . $id,
            'location' => 'nullable|string',
            'status' => 'sometimes|in:OPERATIONAL,MAINTENANCE,OUT_OF_SERVICE,RETIRED',
            'last_maintenance' => 'nullable|date',
            'next_maintenance' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $equipment->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Equipment updated successfully',
            'data' => $equipment,
        ]);
    }

    /**
     * Delete equipment
     */
    public function destroy($id)
    {
        $equipment = Equipment::findOrFail($id);
        $equipment->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Equipment deleted successfully',
        ]);
    }
}