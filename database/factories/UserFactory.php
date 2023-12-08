<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
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
        return [
            'name' => fake()->name(),
            'username' => fake()->userName,
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * @param string $password
     * @return Factory
     */
    public function setPassword(string $password): Factory
    {
        return $this->state(function (array $attributes) use ($password) {
            return [
                'password' => Hash::make($password),
            ];
        });
    }

    /**
     * @param string $userName
     * @return Factory
     */
    public function setUserName(string $userName): Factory
    {
        return $this->state(function (array $attributes) use ($userName) {
            return [
                'username' => $userName,
            ];
        });
    }

    /**
     * @param string $name
     * @return Factory
     */
    public function setName(string $name): Factory
    {
        return $this->state(function (array $attributes) use ($name) {
            return [
                'name' => $name,
            ];
        });
    }
}
