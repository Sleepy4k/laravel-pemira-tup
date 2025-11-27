<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Batch>
 */
class BatchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $currentTime = now();
        $currentYear = date('Y');

        $batches = [];

        for ($i = 5; $i >= 0; $i--) {
            $batches[] = $currentYear - $i;
        }

        $uuids = collect(range(1, count($batches)))
            ->map(fn() => (string) Str::uuid())
            ->sort()
            ->values()
            ->all();

        return array_map(function ($batchName) use ($currentTime, &$uuids) {
            return [
                'id' => array_shift($uuids),
                'name' => $batchName,
                'description' => "Angkatan {$batchName} Universitas Telkom Purwokerto",
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
            ];
        }, $batches);
    }
}
