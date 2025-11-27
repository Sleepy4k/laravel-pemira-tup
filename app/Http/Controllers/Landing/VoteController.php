<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Setting;
use App\Models\Vote;
use App\Models\Voter;
use App\Support\AttributeEncryptor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\Rule;

class VoteController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected array $rateLimiter = [],
        protected ?string $rateLimiterKey = null,
    ) {
        $this->rateLimiterKey = 'voting:' . request()->ip();
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

        return view('landing.vote', compact('rateLimiter'));
    }

    /**
     * Show the form for voting.
     */
    public function show(Voter $voter)
    {
        $sessionVoterId = session('voter_id');
        $bypassVerification = session('bypass_token_verification', false);

        if ($voter->id !== $sessionVoterId || !$bypassVerification) {
            abort(403, 'Unauthorized access to voting page.');
        }

        $candidates = Candidate::with(['missions', 'vision', 'programs'])->get();

        return view('landing.vote-candidate', compact('voter', 'candidates'));
    }

    /**
     * Store the voter's choice.
     */
    public function store(Request $request, Voter $voter)
    {
        try {
            $sessionVoterId = session('voter_id');
            $bypassVerification = session('bypass_token_verification', false);

            if ($voter->id !== $sessionVoterId || !$bypassVerification) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized access to submit vote.',
                ], 403);
            }

            if ($voter->has_voted) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Anda sudah melakukan voting sebelumnya.',
                ], 403);
            }

            $request->validate([
                'candidate_id' => ['required', 'string', Rule::exists(Candidate::class, 'id')],
            ]);

            DB::beginTransaction();

            $voter->load('batch:id', 'batch.votingSession:id,batch_id');
            $voter->voted_at = now();
            $voter->has_voted = true;
            $voter->save();

            Vote::create([
                'candidate_id' => $request->input('candidate_id'),
                'voting_session_id' => $voter->batch->votingSession->id,
            ]);

            session(['already_voted' => true]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Vote berhasil dikirim!',
                'redirect_url' => route('vote.thankyou'),
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error submitting vote: ' . $th->getMessage(), [
                'voter_id' => $voter->id,
                'exception' => $th,
            ]);
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mengirim vote. Silakan coba lagi.',
            ], 500);
        }
    }

    /**
     * Verify the voter's token.
     */
    public function verify(Request $request)
    {
        if (RateLimiter::tooManyAttempts($this->rateLimiterKey, 5)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Too many verify attempts. Please try again later.',
                'data' => $this->rateLimiter,
            ], 429);
        }

        RateLimiter::hit($this->rateLimiterKey, 120);

        $request->validate([
            'token' => ['required', 'string', 'min:10', 'max:15'],
        ]);

        $token = AttributeEncryptor::encrypt(strtoupper($request->input('token')));
        $voter = Voter::select('id', 'vote_token', 'has_voted', 'batch_id')
            ->where('vote_token', $token)
            ->with('batch:id', 'batch.votingSession:id,batch_id,start_time,end_time')
            ->first();

        if (!$voter) {
            return response()->json([
                'status' => 'error',
                'message' => 'Token tidak valid. Silakan coba lagi.',
            ], 404);
        }

        if ($voter->has_voted) {
            return response()->json([
                'status' => 'error',
                'message' => 'Token sudah digunakan untuk voting.',
            ], 403);
        }

        $votingSession = $voter->batch->votingSession;
        $currentTime = now();

        if (!$votingSession || $currentTime->lt($votingSession->start_time) || $currentTime->gt($votingSession->end_time)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Sesi voting untuk batch Anda tidak aktif saat ini.',
            ], 403);
        }

        $request->session()->regenerate();
        session(['voter_id' => $voter->id]);
        session(['bypass_token_verification' => true]);

        return response()->json([
            'status' => 'success',
            'message' => 'Token valid. Silakan lanjutkan ke halaman voting.',
            'redirect_url' => route('vote.show', ['voter' => $voter->id]),
        ]);
    }

    /**
     * Show thank you page after voting.
     */
    public function thankyou(Request $request)
    {
        $request->session()->regenerate();
        $isAlreadyVoted = session('already_voted', false);

        if (!$isAlreadyVoted) {
            return to_route('vote.index');
        }

        $endTime = Setting::select('value')
            ->where('group', 'voting')
            ->where('key', 'end')
            ->first()
            ?->value ?? null;

        return view('landing.vote-thankyou', compact('endTime'));
    }
}
