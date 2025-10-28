<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'address' => fake()->address(),
            'default_currency' => fake()->currencyCode(),
            'display_invoice_amount' => fake()->boolean(),
            'logo' => 'company_logos/' . fake()->image('public/storage/company_logos', 300, 300, null, false)
        ];
    }
}
