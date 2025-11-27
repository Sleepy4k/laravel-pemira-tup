<?php

namespace Database\Factories;

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
                'name' => 'Admin PEMIRA TUP',
                'username' => 'admin',
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
                'name' => $user['name'],
                'username' => AttributeEncryptor::encrypt($user['username']),
                'password' => static::$password ??= Hash::make('password'),
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
            ];
        }, $data);
    }
}
