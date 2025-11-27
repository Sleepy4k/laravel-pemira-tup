<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SigninRequest;
use App\Models\User;
use App\Support\AttributeEncryptor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class SigninController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected array $rateLimiter = [],
        protected ?string $rateLimiterKey = null,
    ) {
        $this->rateLimiterKey = 'signin:' . request()->ip();
        $this->rateLimiter = [
            'reset_at' => RateLimiter::availableIn($this->rateLimiterKey),
            'remaining' => RateLimiter::remaining($this->rateLimiterKey, 5),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rateLimiter = $this->rateLimiter;

        return view('auth.signin', compact('rateLimiter'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SigninRequest $request)
    {
        if (RateLimiter::tooManyAttempts($this->rateLimiterKey, 5)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Too many login attempts. Please try again later.',
                'data' => $this->rateLimiter,
            ], 429);
        }

        RateLimiter::hit($this->rateLimiterKey, 120);

        $body = $request->validated();
        $body['username'] = AttributeEncryptor::encrypt($body['username']);
        $user = User::query()
            ->select('username', 'password')
            ->where('username', $body['username'])
            ->first();

        if (!$user || !Auth::attempt($body)) {
            return response()->json([
                'status' => 'error',
                'message' => 'The provided credentials are incorrect.',
                'data' => $this->rateLimiter,
            ], 422);
        }

        RateLimiter::clear($this->rateLimiterKey);
        $request->session()->regenerate();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully signed in.',
            'data' => $this->rateLimiter,
        ]);
    }
}
