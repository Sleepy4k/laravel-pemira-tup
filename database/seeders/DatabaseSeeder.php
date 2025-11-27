<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Artisan::call('optimize:clear', [
            '--no-interaction' => true,
            '--quiet' => true,
        ]);

        $this->call([
            SettingSeeder::class,
            BatchSeeder::class,
            VotingSessionSeeder::class,
            UserSeeder::class,
        ]);
    }
}
