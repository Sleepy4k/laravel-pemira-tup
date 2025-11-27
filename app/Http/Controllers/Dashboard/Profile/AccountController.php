<?php

namespace App\Http\Controllers\Dashboard\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = auth('web')->user();
        $initialName = strtoupper(substr($user->name, 0, 1));

        return view('dashboard.profile.account', compact('user', 'initialName'));
    }
}
