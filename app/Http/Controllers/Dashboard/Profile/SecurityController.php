<?php

namespace App\Http\Controllers\Dashboard\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\SecurityRequest;

class SecurityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth('web')->user();
        $initialName = strtoupper(substr($user->name, 0, 1));

        return view('dashboard.profile.security', compact('user', 'initialName'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SecurityRequest $request)
    {
        $data = $request->validated();

        $user = auth('web')->user();

        // Verify current password
        if (!password_verify($data['current_password'], $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Current password is incorrect.',
            ], 422);
        }

        // Update to new password
        $user->password = $data['password'];
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Password updated successfully.',
        ], 200);
    }
}
