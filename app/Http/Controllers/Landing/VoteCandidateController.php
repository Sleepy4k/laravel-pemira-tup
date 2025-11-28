<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\CandidateType;
use Illuminate\Http\Request;

class VoteCandidateController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(CandidateType $type)
    {
        $candidates = $type
            ->load('candidates', 'candidates.vision', 'candidates.missions')
            ->get();

        return view('landing.vote-candidate', compact('type', 'candidates'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CandidateType $type, Candidate $candidate)
    {
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
        ]);

        $user = $request->user();

        // Remove previous vote for this candidate type
        $user->votes()->whereHas('candidate', function ($query) use ($type) {
            $query->where('candidate_type_id', $type->id);
        })->delete();

        // Add new vote
        $user->votes()->create([
            'candidate_id' => $request->input('candidate_id'),
        ]);

        return redirect()->route('landing.voting')->with('success', 'Vote submitted successfully.');
    }
}
