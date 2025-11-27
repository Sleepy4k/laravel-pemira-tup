<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Candidate;
use App\Models\Voter;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $votes = Voter::select('id', 'has_voted', 'batch_id')
            ->with('batch:id,name')
            ->get();

        $totalVoters = $votes->count();
        $votingStatus = [
            'hasVoted' => $votes->where('has_voted', true)->count(),
            'notVoted' => $votes->where('has_voted', false)->count(),
        ];

        $votesGroupedByBatch = $votes->groupBy('batch.id')->sortBy(function ($group, $key) {
            return $group->first()->batch->name;
        });
        $votesPerBatch = [
            ['name' => 'Voted', 'data' => []],
            ['name' => 'Not Voted', 'data' => []],
        ];

        foreach ($votesGroupedByBatch as $voters) {
            $votesPerBatch[0]['data'][] = $voters->where('has_voted', true)->count();
            $votesPerBatch[1]['data'][] = $voters->where('has_voted', false)->count();
        }

        $batchIds = $votes->pluck('batch.id')->unique()->toArray();
        $batches = Batch::select('name')->whereIn('id', $batchIds)->get();

        if ($batches->isEmpty()) {
            $batches = Batch::select('name')->orderBy('name')->get();
        }

        $candidates = Candidate::withCount('votes')->get();
        $candidateCategories = $candidates->map(function ($candidate) {
            return $candidate->name . ' (' . $candidate->number . ')';
        })->toArray();

        $votesPerCandidate = [
            [
                'name' => 'Votes',
                'data' => $candidates->pluck('votes_count')->toArray(),
            ]
        ];

        $votesPerCandidateForPie = $candidates->mapWithKeys(function ($candidate) {
            return [$candidate->name => $candidate->votes_count];
        })->toArray();

        return view('dashboard.home', compact(
            'votesPerBatch', 'votingStatus',
            'batches', 'totalVoters',
            'candidates', 'votesPerCandidate',
            'candidateCategories', 'votesPerCandidateForPie'
        ));
    }
}
