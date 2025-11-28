<?php

namespace Database\Seeders;

use App\Models\CandidateType;
use Illuminate\Database\Seeder;

class CandidateTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (CandidateType::query()->withoutCache()->count() > 0) return;

        $types = CandidateType::factory()->make();

        CandidateType::insert($types->toArray());
    }
}
