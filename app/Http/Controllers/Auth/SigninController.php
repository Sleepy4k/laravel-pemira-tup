<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Support\AttributeEncryptor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class SigninController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Socialite::driver('microsoft')->redirect();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        try {
            $socialiteUser = Socialite::driver('microsoft')->user();

            $email = strtolower($socialiteUser->getEmail());
            $encryptedEmail = AttributeEncryptor::encrypt($email);
            $user = User::query()
                ->select('email')
                ->where('email', $encryptedEmail)
                ->first();

            if (!$user) {
                Log::warning('Signin attempt with unregistered account: ' . $socialiteUser->getEmail());
                return to_route('landing')->withErrors([
                    'signin' => 'Your account is not registered in the system.',
                ]);
            }

            $user->update([
                'socialite_id' => $socialiteUser->getId(),
                'socialite_token' => $socialiteUser->token,
            ]);

            if (!Auth::attempt(['email' => $encryptedEmail, 'password' => 'password'])) {
                Log::error('Failed to authenticate user after socialite sign-in: ' . $socialiteUser->getEmail());
                return to_route('landing')->withErrors([
                    'signin' => 'An error occurred during sign-in. Please try again.',
                ]);
            }

            return to_route('landing')->with('status', 'Successfully signed in.');
        } catch (\Throwable $th) {
            Log::error('Signin error: ' . $th->getMessage());
            return to_route('landing')->withErrors([
                'signin' => 'An error occurred during sign-in. Please try again.',
            ]);
        }
    }
}
