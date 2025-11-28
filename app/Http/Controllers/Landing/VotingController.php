<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\CandidateType;
use Illuminate\Http\Request;

class VotingController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = auth('web')->user();
        $types = CandidateType::query()
            ->select('id', 'name', 'slug', 'description')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('landing.voting', compact('types', 'user'));
    }
}
