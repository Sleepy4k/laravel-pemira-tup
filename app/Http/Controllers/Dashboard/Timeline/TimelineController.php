<?php

namespace App\Http\Controllers\Dashboard\Timeline;

use App\DataTables\Timeline\TimelineDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Timeline\StoreRequest;
use App\Http\Requests\Dashboard\Timeline\UpdateRequest;
use App\Models\Timeline;
use Illuminate\Support\Facades\Log;

class TimelineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TimelineDataTable $dataTable)
    {
        return $dataTable->render('dashboard.timelines.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        try {
            $timeline = Timeline::create($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Timeline created successfully.',
                'data' => $timeline,
            ], 201);
        } catch (\Throwable $th) {
            Log::error('Error creating timeline: ' . $th->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create timeline.',
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Timeline $timeline)
    {
        $data = $request->validated();

        try {
            $timeline->update($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Timeline updated successfully.',
                'data' => $timeline,
            ]);
        } catch (\Throwable $th) {
            Log::error('Error updating timeline: ' . $th->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update timeline.',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Timeline $timeline)
    {
        try {
            $timeline->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Timeline deleted successfully.',
            ]);
        } catch (\Throwable $th) {
            Log::error('Error deleting timeline: ' . $th->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete timeline.',
            ], 500);
        }
    }
}
