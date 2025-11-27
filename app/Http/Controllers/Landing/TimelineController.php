<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Timeline;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $currentDate = now()->toDateString();
        $timelines = Timeline::query()
            ->orderBy('start_date', 'asc')
            ->get();

        return view('landing.timeline', compact('timelines', 'currentDate'));
    }
}
