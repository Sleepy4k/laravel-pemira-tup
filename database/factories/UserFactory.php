<?php

namespace Database\Factories;

use App\Models\Batch;
use App\Support\AttributeEncryptor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

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
                'name' => 'APRI PANDU WICAKSONO',
                'email' => 'apripandu@student.telkomuniversity.ac.id',
                'is_admin' => true,
                'batch_id' => Batch::query()->first()->id,
            ]
        ];

        $uuids = collect(range(1, count($data)))
            ->map(fn() => (string) Str::uuid())
            ->sort()
            ->values()
            ->all();

        return array_map(function ($user) use ($currentTime, &$uuids) {
            return [
                'id' => array_shift($uuids),
                'name' => AttributeEncryptor::encrypt($user['name']),
                'email' => AttributeEncryptor::encrypt($user['email']),
                'is_admin' => $user['is_admin'],
                'batch_id' => $user['batch_id'],
                'password' => static::$password ??= Hash::make('password'),
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
            ];
        }, $data);
    }
}
