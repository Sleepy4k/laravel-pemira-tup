<?php

namespace Database\Seeders;

use App\Models\VotingSession;
use Illuminate\Database\Seeder;

class VotingSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (VotingSession::query()->withoutCache()->count() > 0) return;

        $sessions = VotingSession::factory()->make();

        VotingSession::insert($sessions->toArray());
    }
}
