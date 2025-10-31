<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InvoiceForAttention>
 */
class InvoiceForAttentionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $possiblePeriods = [];
        for($i = 1; $i <= 28; $i++){
            if($i == 1){
                $possiblePeriods[] = $i . ' day';
            } else {
                $possiblePeriods[] = $i. ' days';
            }
        }

        return [
            'period' => $possiblePeriods[rand(0, 27)]
        ];

    }
}
