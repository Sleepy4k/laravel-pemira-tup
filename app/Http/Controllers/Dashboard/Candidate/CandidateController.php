<?php

namespace App\Http\Controllers\Dashboard\Candidate;

use App\DataTables\Candidate\CandidateDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Candidate\StoreRequest;
use App\Http\Requests\Dashboard\Candidate\UpdateRequest;
use App\Models\Candidate;
use App\Models\CandidateMission;
use App\Models\CandidateProgram;
use App\Models\CandidateVision;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CandidateDataTable $dataTable)
    {
        return $dataTable->render('dashboard.candidates.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.candidates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();

            $candidate = Candidate::create([
                'number' => $data['number'],
                'head_name' => $data['head_name'],
                'vice_name' => $data['vice_name'],
                'photo' => $data['photo'] ?? null,
                'resume' => $data['resume'] ?? null,
                'attachment' => $data['attachment'] ?? null,
            ]);

            CandidateVision::create([
                'candidate_id' => $candidate->id,
                'vision' => $data['vision'],
            ]);

            foreach ($data['missions'] as $mission) {
                CandidateMission::create([
                    'candidate_id' => $candidate->id,
                    'point' => $mission,
                ]);
            }

            foreach ($data['programs'] as $program) {
                CandidateProgram::create([
                    'candidate_id' => $candidate->id,
                    'point' => $program,
                ]);
            }

            DB::commit();

            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Candidate created successfully.',
                    'data' => $candidate,
                ], 201);
            }

            return to_route('dashboard.candidates.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error creating candidate: '.$th->getMessage());

            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to create candidate.',
                    'data' => null,
                ], 500);
            }

            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Candidate $candidate)
    {
        return view('dashboard.candidates.show', compact('candidate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Candidate $candidate)
    {
        return view('dashboard.candidates.update', compact('candidate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Candidate $candidate)
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();

            $payload = [
                'number' => $data['number'],
                'head_name' => $data['head_name'],
                'vice_name' => $data['vice_name'],
                'photo' => $data['photo'] ?? null,
                'resume' => $data['resume'] ?? null,
                'attachment' => $data['attachment'] ?? null,
            ];

            if (!isset($data['photo']) || empty($data['photo'])) {
                unset($payload['photo']);
            }

            if (!isset($data['resume']) || empty($data['resume'])) {
                unset($payload['resume']);
            }

            if (!isset($data['attachment']) || empty($data['attachment'])) {
                unset($payload['attachment']);
            }

            $candidate->update($payload);

            $candidate->vision()->update([
                'vision' => $data['vision'],
            ]);

            $candidate->missions()->delete();
            foreach ($data['missions'] as $mission) {
                CandidateMission::create([
                    'candidate_id' => $candidate->id,
                    'point' => $mission,
                ]);
            }

            $candidate->programs()->delete();
            foreach ($data['programs'] as $program) {
                CandidateProgram::create([
                    'candidate_id' => $candidate->id,
                    'point' => $program,
                ]);
            }

            DB::commit();

            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Candidate updated successfully.',
                    'data' => $candidate,
                ], 200);
            }

            return to_route('dashboard.candidates.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error updating candidate: '.$th->getMessage());

            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to update candidate.',
                    'data' => null,
                ], 500);
            }

            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidate $candidate)
    {
        try {
            $candidate->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Candidate deleted successfully.',
                'data' => null,
            ], 200);
        } catch (\Throwable $th) {
            Log::error('Error deleting candidate: '.$th->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete candidate.',
                'data' => null,
            ], 500);
        }
    }
}
