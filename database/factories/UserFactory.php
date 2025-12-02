<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use libphonenumber\PhoneNumberUtil;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberType;
use App\Models\Role;



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
        $countries = ["RO", "FR"];
        $country = $this->faker->randomElement($countries);

        // Generează un număr valid pentru regiune
        try {
            // Creează un număr fictiv valid pentru regiune
            $exampleNumber = $phoneUtil->getExampleNumberForType($country, PhoneNumberType::MOBILE);
            $international = $phoneUtil->format($exampleNumber, PhoneNumberFormat::E164);
        } catch (\libphonenumber\NumberParseException $e) {
            $international = '+40729626513'; // fallback
        }

        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'role_id' => fake()->numberBetween(1, Role::count()),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'country' => $country,
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
