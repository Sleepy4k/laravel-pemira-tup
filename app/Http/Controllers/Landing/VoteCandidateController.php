<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Http\Requests\Landing\VoteCandidateRequest;
use App\Models\Candidate;
use App\Models\CandidateType;
use App\Models\VoterHistory;
use App\Models\VotingSession;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VoteCandidateController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(CandidateType $type)
    {
        $votedTypeIds = auth('web')->user()->load('voterHistories')
            ->voterHistories
            ->pluck('candidate_type_id')
            ->toArray();

        if (in_array($type->id, $votedTypeIds)) {
            return redirect()->route('voting')->with('error', 'Anda sudah memilih kandidat untuk kategori ini.');
        }

        $type->load('candidates', 'candidates.vision', 'candidates.missions');

        return view('landing.vote-candidate', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VoteCandidateRequest $request, CandidateType $type, Candidate $candidate)
    {
        try {
            $body = $request->validated();
            $user = auth('web')->user()->load('batch');

            $voteSession = VotingSession::where('batch_id', $user->batch->id)
                ->first();

            if (!$voteSession || ($voteSession->start_time > now()) || ($voteSession->end_time < now())) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sesi pemilihan belum dimulai atau sudah berakhir.',
                ], 403);
            }

            if (!$type->is_active) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kategori kandidat ini tidak aktif untuk pemilihan.',
                ], 403);
            }

            if ($body['user_id'] !== $user->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pemilih tidak sesuai dengan data autentikasi. Silakan login ulang.',
                ], 403);
            }

            if ($body['candidate_id'] !== $candidate->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kandidat yang dipilih tidak sesuai dengan data yang dikirimkan.',
                ], 400);
            }

            DB::beginTransaction();

            // check if user has already voted for this candidate type
            $existingVote = VoterHistory::where('user_id', $user->id)
                ->where('candidate_type_id', $type->id)
                ->first();

            if ($existingVote) {
                return response()->json([
                    'success' => false,
                    'message' => 'Maaf, Anda sudah memilih kandidat untuk kategori ini.',
                ], 409);
            }

            // create voter history
            VoterHistory::create([
                'user_id' => $user->id,
                'candidate_type_id' => $type->id,
                'voted_at' => now(),
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Terima kasih telah memilih kandidat.',
                'redirect_url' => route('voting'),
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error saat memilih kandidat: ' . $th->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses pilihan Anda. Silakan coba lagi.',
            ], 500);
        }
    }
}
