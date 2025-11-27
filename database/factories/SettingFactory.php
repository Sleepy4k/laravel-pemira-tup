<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $currentTime = now();
        $defaultLogo = asset('images/pemira.png', (bool) !config('app.debug', false));

        $data = [
            [
                'group' => 'app',
                'key' => 'name',
                'value' => config('app.name', 'PEMIRA TUP'),
            ],
            [
                'group' => 'app',
                'key' => 'description',
                'value' => 'Pemilihan Raya Universitas Telkom Purwokerto adalah sebuah acara tahunan yang diselenggarakan untuk memilih presiden dan wakil presiden mahasiswa serta memilih ketua umum dewan perwakilan mahasiswa Universitas Telkom Purwokerto',
            ],
            [
                'group' => 'app',
                'key' => 'logo',
                'value' => $defaultLogo,
                'is_required' => false,
                'is_file' => true,
            ],
            [
                'group' => 'app',
                'key' => 'favicon',
                'value' => $defaultLogo,
                'is_required' => false,
                'is_file' => true,
            ],
            [
                'group' => 'seo',
                'key' => 'keywords',
                'value' => 'PEMIRA, TUP, Pemira TUP, Universitas Telkom Purwokerto, pemilihan, pemilu mahasiswa, calon ketua, calon pengurus, organisasi mahasiswa, kepemimpinan, mahasiswa telkom, kampus, debat kandidat, visi misi, suara, kandidat, pendaftaran kandidat, kampanye, kegiatan kemahasiswaan, pemira elektronik, vote, election, student council, presma, wapresma, dpm, bem, dewan pewarilan mahasiswa, badan eksekutif mahasiswa',
                'type' => 'text',
            ],
            [
                'group' => 'seo',
                'key' => 'author',
                'value' => 'Universitas Telkom Purwokerto',
            ],
            [
                'group' => 'seo',
                'key' => 'description',
                'value' => 'Pemilihan Raya Universitas Telkom Purwokerto adalah sebuah acara tahunan yang diselenggarakan untuk memilih presiden dan wakil presiden mahasiswa serta memilih ketua umum dewan perwakilan mahasiswa Universitas Telkom Purwokerto',
                'type' => 'text',
            ],
            [
                'group' => 'seo',
                'key' => 'image_width',
                'value' => 1200,
                'type' => 'integer',
            ],
            [
                'group' => 'seo',
                'key' => 'image_height',
                'value' => 630,
                'type' => 'integer',
            ],
            [
                'group' => 'voting',
                'key' => 'start',
                'value' => $currentTime->year . '-11-24 08:00:00',
                'type' => 'datetime',
            ],
            [
                'group' => 'voting',
                'key' => 'end',
                'value' => $currentTime->year . '-11-24 18:00:00',
                'type' => 'datetime',
            ],
        ];

        return array_map(function ($setting) use ($currentTime) {
            return [
                'group' => $setting['group'],
                'key' => $setting['key'],
                'value' => $setting['value'],
                'type' => isset($setting['type']) ? $setting['type'] : 'string',
                'is_required' => isset($setting['is_required']) ? $setting['is_required'] : true,
                'is_file' => isset($setting['is_file']) ? $setting['is_file'] : false,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
            ];
        }, $data);
    }
}
