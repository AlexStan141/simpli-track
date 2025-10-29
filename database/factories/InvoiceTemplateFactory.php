<?php

namespace Database\Factories;

use App\Models\InvoiceTemplate;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InvoiceTemplate>
 */
class InvoiceTemplateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'frequency' => fake()->randomElement(InvoiceTemplate::$frequencies),
            'amount' => fake()->numberBetween(100,3000),
            'currency' => fake() -> currencyCode(),
            'lease_no' => 'DHQ55 #' . Carbon::now()->addDays(rand(0, 365))->format('Y/m/d'),
            'due_date' => fake()->numberBetween(1, 28),
            'invoices_for_attention' => fake()->numberBetween(1,10) . ' days',
        ];
    }
}
