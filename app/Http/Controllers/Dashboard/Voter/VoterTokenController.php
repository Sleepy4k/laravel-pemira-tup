<?php

namespace App\Http\Controllers\Dashboard\Voter;

use App\Http\Controllers\Controller;
use App\Models\Voter;
use App\Notifications\SendVoteToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class VoterTokenController extends Controller
{
    /**
     * Send vote token notification to a specific voter.
     */
    public function sendNotification(Request $request, Voter $voter)
    {
        try {
            $voter->load('batch:id', 'batch.votingSession:id,batch_id,start_time,end_time');
            $voteTime = $voter->batch->votingSession
                ? $voter->batch->votingSession->start_time->format('d M Y H:i') . ' - ' . $voter->batch->votingSession->end_time->format('d M Y H:i')
                : 'Waktu pemilihan belum ditentukan.';

            Notification::send($voter, new SendVoteToken(voteToken: $voter->vote_token, voteTime: $voteTime));

            return response()->json([
                'status' => 'success',
                'message' => 'Vote token notification sent successfully.',
            ]);
        } catch (\Throwable $th) {
            Log::error('Error sending vote token notification to voter ID ' . $voter->id . ': ' . $th->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to send vote token notification.',
            ], 500);
        }
    }

    /**
     * Send vote token notifications to all voters.
     */
    public function bulkSendNotification(Request $request)
    {
        try {
            Voter::with('batch:id', 'batch.votingSession:id,batch_id,start_time,end_time')
            ->chunk(5, function ($voters) {
                foreach ($voters as $voter) {
                    $voteTime = $voter->batch->votingSession
                        ? $voter->batch->votingSession->start_time->format('d M Y H:i') . ' - ' . $voter->batch->votingSession->end_time->format('d M Y H:i')
                        : 'Waktu pemilihan belum ditentukan.';

                    Notification::send($voter, new SendVoteToken(voteToken: $voter->vote_token, voteTime: $voteTime));
                }
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Vote token notifications are being sent in the background.',
            ]);
        } catch (\Throwable $th) {
            Log::error('Error queuing vote token notifications: ' . $th->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to queue vote token notifications.',
            ], 500);
        }
    }
}
