<?php

namespace Database\Factories;

use App\Models\User;
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

    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            "username"	=>	fake()->userName,
            "email"	=>	fake()->unique()->email(),
            "user_password"	=>	static::$password ??= Hash::make('user1234'),
            "mobile_no"	=>	fake()->phoneNumber(),
            //"role_id"	=>	999999999,
            "first_name"	=>	fake()->firstName(),
            "last_name"	=>	fake()->lastName(),
            "occupation"	=>	fake()->jobTitle(),
            "education"	=>	fake()->randomElement(['bs','ms',"phd"]),
            "country"	=>	fake()->country(),
            "city"	=>	fake()->city,
            "area"	=>	fake()->streetAddress,
            "sex"	=>	fake()->randomElement(["Male","Female"]),
            "dob"	=>	fake()->date()
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
