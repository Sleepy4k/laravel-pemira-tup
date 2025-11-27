<?php

namespace App\Http\Controllers\Dashboard\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\SettingRequest;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth('web')->user();
        $initialName = strtoupper(substr($user->name, 0, 1));

        return view('dashboard.profile.setting', compact('user', 'initialName'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SettingRequest $request)
    {
        $data = $request->validated();

        $user = auth('web')->user();

        $user->name = $data['name'];
        $user->username = $data['username'];
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Profile settings updated successfully.',
        ], 200);
    }
}
