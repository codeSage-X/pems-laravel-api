<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Get all clients
     */
    public function index(Request $request)
    {
        $query = Client::query();

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'ILIKE', "%{$search}%")
                  ->orWhere('code', 'ILIKE', "%{$search}%");
            });
        }

        $clients = $query->paginate($request->get('per_page', 10));

        return response()->json([
            'status' => 'success',
            'data' => $clients,
        ]);
    }

    /**
     * Get single client
     */
    public function show($id)
    {
        $client = Client::with('jobs')->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $client,
        ]);
    }
}