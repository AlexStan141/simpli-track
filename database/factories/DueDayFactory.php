<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DueDay>
 */
class DueDayFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $possibleDays = [];
        for($i = 1; $i <= 28; $i++){
            if($i == 1 || $i == 21){
                $possibleDays[] = $i . 'st';
            }
            else if($i == 2 || $i == 22){
                $possibleDays[] = $i . 'nd';
            }
            else if($i == 3 || $i == 23){
                $possibleDays[] = $i . 'rd';
            }
            else {
                $possibleDays[] = $i . 'th';
            }
        }
        return [
            'day' => $possibleDays[rand(0, 27)]
        ];
    }
}
