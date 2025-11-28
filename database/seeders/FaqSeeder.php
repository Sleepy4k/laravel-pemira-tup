<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Faq::query()->withoutCache()->count() > 0) return;

        $faqs = Faq::factory()->make();

        Faq::insert($faqs->toArray());
    }
}
