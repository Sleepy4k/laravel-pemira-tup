<?php

namespace App\Http\Controllers\Dashboard\Batch;

use App\DataTables\Batch\BatchDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Batch\StoreRequest;
use App\Http\Requests\Dashboard\Batch\UpdateRequest;
use App\Models\Batch;
use Illuminate\Support\Facades\Log;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BatchDataTable $dataTable)
    {
        return $dataTable->render('dashboard.batches.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        try {
            $batch = Batch::create($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Batch created successfully.',
                'data' => $batch,
            ], 201);
        } catch (\Throwable $th) {
            Log::error('Error creating batch: ' . $th->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create batch.',
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Batch $batch)
    {
        $data = $request->validated();

        try {
            $batch->update($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Batch updated successfully.',
                'data' => $batch,
            ], 200);
        } catch (\Throwable $th) {
            Log::error('Error updating batch: ' . $th->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update batch.',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Batch $batch)
    {
        try {
            $batch->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Batch deleted successfully.',
            ], 200);
        } catch (\Throwable $th) {
            Log::error('Error deleting batch: ' . $th->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete batch.',
            ], 500);
        }
    }
}
