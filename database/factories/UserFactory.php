<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use libphonenumber\PhoneNumberUtil;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberType;



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

        $phoneUtil = PhoneNumberUtil::getInstance();

        // Lista de regiuni ISO (poți extinde)
        $regions = ['US', 'GB', 'FR', 'DE', 'JP', 'RO', 'CN', 'IN', 'BR', 'AU'];
        $region = $this->faker->randomElement($regions);

        // Generează un număr valid pentru regiune
        try {
            // Creează un număr fictiv valid pentru regiune
            $exampleNumber = $phoneUtil->getExampleNumberForType($region, PhoneNumberType::MOBILE);
            $international = $phoneUtil->format($exampleNumber, PhoneNumberFormat::E164);
        } catch (\libphonenumber\NumberParseException $e) {
            $international = '+40729626513'; // fallback
        }

        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'role' => fake()->randomElement(User::$role),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'phone' => $international
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
