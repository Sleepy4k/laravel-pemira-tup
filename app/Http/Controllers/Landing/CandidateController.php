<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $candidates = Candidate::with(['missions', 'vision', 'programs'])->get();

        return view('landing.candidate', compact('candidates'));
    }
}
