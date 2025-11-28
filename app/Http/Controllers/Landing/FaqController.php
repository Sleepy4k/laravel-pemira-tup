<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $faqs = Faq::query()->select('question', 'answer')->orderBy('created_at', 'asc')->get();

        return view('landing.faq', compact('faqs'));
    }
}
