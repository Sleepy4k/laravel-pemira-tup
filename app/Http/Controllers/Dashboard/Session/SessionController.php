<?php

namespace App\Http\Controllers\Dashboard\Session;

use App\DataTables\Session\SessionDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Session\StoreRequest;
use App\Http\Requests\Dashboard\Session\UpdateRequest;
use App\Models\Batch;
use App\Models\Setting;
use App\Models\VotingSession;
use Illuminate\Support\Facades\Log;

use function Symfony\Component\Clock\now;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SessionDataTable $dataTable)
    {
        $batches = Batch::select('id', 'name')->get();
        $settings = Setting::where('group', 'voting')->get()->pluck('value', 'key')->toArray();
        $start_date = date('Y-m-d\TH:i:s', strtotime($settings['start'] ?? now()));
        $end_date = date('Y-m-d\TH:i:s', strtotime($settings['end'] ?? now()));

        return $dataTable->render('dashboard.sessions.index', compact('batches', 'start_date', 'end_date'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        try {
            $session = VotingSession::create($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Session created successfully.',
                'data' => $session,
            ], 201);
        } catch (\Throwable $th) {
            Log::error('Error creating session: ' . $th->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create session.',
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, VotingSession $session)
    {
        $data = $request->validated();

        try {
            $session->update($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Session updated successfully.',
                'data' => $session,
            ], 200);
        } catch (\Throwable $th) {
            Log::error('Error updating session: ' . $th->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update session.',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VotingSession $session)
    {
        try {
            $session->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Session deleted successfully.',
            ], 200);
        } catch (\Throwable $th) {
            Log::error('Error deleting session: ' . $th->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete session.',
            ], 500);
        }
    }
}
