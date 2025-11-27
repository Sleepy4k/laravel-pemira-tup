<?php

namespace Database\Seeders;

use App\Models\Batch;
use Illuminate\Database\Seeder;

class BatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Batch::query()->withoutCache()->count() > 0) return;

        $batches = Batch::factory()->make();

        Batch::insert($batches->toArray());
    }
}
