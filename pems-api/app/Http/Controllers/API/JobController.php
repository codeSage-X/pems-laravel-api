<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Get all jobs with filters
     */
    public function index(Request $request)
    {
        $query = Job::with(['employee', 'client']);

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by priority
        if ($request->has('priority')) {
            $query->where('priority', $request->priority);
        }

        // Filter by type
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        // Filter by employee
        if ($request->has('employee_id')) {
            $query->where('employee_id', $request->employee_id);
        }

        // Filter by client
        if ($request->has('client_id')) {
            $query->where('client_id', $request->client_id);
        }

        // Search by title
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('title', 'ILIKE', "%{$search}%");
        }

        // Filter by date range
        if ($request->has('start_date')) {
            $query->whereDate('scheduled_date', '>=', $request->start_date);
        }

        if ($request->has('end_date')) {
            $query->whereDate('scheduled_date', '<=', $request->end_date);
        }

        // Sort
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $jobs = $query->paginate($request->get('per_page', 10));

        return response()->json([
            'status' => 'success',
            'data' => $jobs,
        ]);
    }

    /**
     * Create new job
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:INSPECTION,MAINTENANCE,REPAIR,INSTALLATION',
            'employee_id' => 'required|exists:users,id',
            'client_id' => 'nullable|exists:clients,id',
            'equipment' => 'nullable|string',
            'logistics' => 'nullable|string',
            'status' => 'nullable|in:PENDING,IN_PROGRESS,COMPLETED,CANCELLED',
            'priority' => 'nullable|in:LOW,MEDIUM,HIGH,CRITICAL',
            'description' => 'nullable|string',
            'scheduled_date' => 'nullable|date',
        ]);

        $job = Job::create($request->all());
        $job->load(['employee', 'client']);

        return response()->json([
            'status' => 'success',
            'message' => 'Job created successfully',
            'data' => $job,
        ], 201);
    }

    /**
     * Get single job
     */
    public function show($id)
    {
        $job = Job::with(['employee', 'client'])->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $job,
        ]);
    }

    /**
     * Update job
     */
    public function update(Request $request, $id)
    {
        $job = Job::findOrFail($id);

        $request->validate([
            'title' => 'sometimes|string|max:255',
            'type' => 'sometimes|in:INSPECTION,MAINTENANCE,REPAIR,INSTALLATION',
            'employee_id' => 'sometimes|exists:users,id',
            'client_id' => 'nullable|exists:clients,id',
            'equipment' => 'nullable|string',
            'logistics' => 'nullable|string',
            'status' => 'sometimes|in:PENDING,IN_PROGRESS,COMPLETED,CANCELLED',
            'priority' => 'sometimes|in:LOW,MEDIUM,HIGH,CRITICAL',
            'description' => 'nullable|string',
            'scheduled_date' => 'nullable|date',
            'completed_date' => 'nullable|date',
        ]);

        $job->update($request->all());
        $job->load(['employee', 'client']);

        return response()->json([
            'status' => 'success',
            'message' => 'Job updated successfully',
            'data' => $job,
        ]);
    }

    /**
     * Update job status only
     */
    public function updateStatus(Request $request, $id)
    {
        $job = Job::findOrFail($id);

        $request->validate([
            'status' => 'required|in:PENDING,IN_PROGRESS,COMPLETED,CANCELLED',
        ]);

        $job->update([
            'status' => $request->status,
            'completed_date' => $request->status === 'COMPLETED' ? now() : null,
        ]);

        $job->load(['employee', 'client']);

        return response()->json([
            'status' => 'success',
            'message' => 'Job status updated successfully',
            'data' => $job,
        ]);
    }

    /**
     * Delete job
     */
    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Job deleted successfully',
        ]);
    }
}