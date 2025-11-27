<?php

namespace Database\Factories;

use App\Models\Batch;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VotingSession>
 */
class VotingSessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $batches = Batch::select('id')->get();

        $currentTime = now();
        $uuids = collect(range(1, count($batches)))
            ->map(fn() => (string) Str::uuid())
            ->sort()
            ->values()
            ->all();

        return array_map(function ($batch) use ($currentTime, &$uuids) {
            return [
                'id' => array_shift($uuids),
                'batch_id' => $batch['id'],
                'start_time' => $currentTime,
                'end_time' => $currentTime->copy()->addHours(4),
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
            ];
        }, $batches->toArray());
    }
}
