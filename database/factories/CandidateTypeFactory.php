<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CandidateType>
 */
class CandidateTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $currentTime = now();
        $data = [
            [
                'name' => 'Dewan Perwakilan Mahasiswa',
                'description' => 'Dewan Perwakilan Mahasiswa merupakan lembaga legislatif mahasiswa yang bertugas mengawasi jalannya organisasi kemahasiswaan dan menyuarakan aspirasi mahasiswa.',
            ],
            [
                'name' => 'Badan Eksekutif Mahasiswa',
                'description' => 'Badan Eksekutif Mahasiswa adalah lembaga eksekutif mahasiswa yang bertanggung jawab dalam menjalankan program kerja dan kegiatan kemahasiswaan di tingkat universitas.',
            ],
        ];

        $uuids = collect(range(1, count($data)))
            ->map(fn() => (string) Str::uuid())
            ->sort()
            ->values()
            ->all();

        return array_map(function ($user) use ($currentTime, &$uuids) {
            return [
                'id' => array_shift($uuids),
                'name' => $user['name'],
                'description' => $user['description'],
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
            ];
        }, $data);
    }
}
