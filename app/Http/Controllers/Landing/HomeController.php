<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $appLogo = Setting::select('group', 'key', 'value')
            ->where('group', 'app')->where('key', 'logo')->first();

        return view('landing.home', [
            'appLogo' => $appLogo ? $appLogo->value : null,
        ]);
    }
}
