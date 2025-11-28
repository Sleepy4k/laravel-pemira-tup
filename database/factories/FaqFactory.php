<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Faq>
 */
class FaqFactory extends Factory
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
                'question' => 'Apa itu Pemira TUP?',
                'answer' => 'Pemira TUP adalah Pemilihan Raya Mahasiswa Teknik Universitas Pelita Harapan yang diadakan setiap tahun untuk memilih perwakilan mahasiswa.'
            ],
            [
                'question' => 'Siapa yang berhak memilih dalam Pemira TUP?',
                'answer' => 'Seluruh mahasiswa aktif Teknik Universitas Pelita Harapan memiliki hak suara dalam Pemira TUP.'
            ],
            [
                'question' => 'Bagaimana cara memberikan suara dalam Pemira TUP?',
                'answer' => 'Mahasiswa dapat memberikan suara melalui platform online yang telah disediakan oleh panitia Pemira TUP.'
            ],
            [
                'question' => 'Kapan jadwal Pemira TUP dilaksanakan?',
                'answer' => 'Jadwal Pemira TUP biasanya diumumkan beberapa minggu sebelum pelaksanaan. Pastikan untuk mengikuti pengumuman resmi dari panitia.'
            ],
            [
                'question' => 'Apakah hasil Pemira TUP dapat diganggu gugat?',
                'answer' => 'Hasil Pemira TUP bersifat final dan tidak dapat diganggu gugat kecuali terdapat bukti kecurangan yang sah.'
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
                'question' => $user['question'],
                'answer' => $user['answer'],
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
            ];
        }, $data);
    }
}
