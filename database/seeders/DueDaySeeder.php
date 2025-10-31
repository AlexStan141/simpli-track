<?php

namespace Database\Seeders;

use App\Models\DueDay;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DueDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function dayWithSuffix($i){
        if($i == 1 || $i == 21){
            return $i . 'st';
        }
        else if($i == 2 || $i == 22){
            return $i . 'nd';
        }
        else if($i == 3 || $i == 23){
            return $i . 'rd';
        }
        else {
            return $i . 'th';
        }
    }
    public function run(): void
    {
        for($i = 1; $i <= 28; $i++){
            DueDay::factory()->create([
                'day' => $this->dayWithSuffix($i)
            ]);
        }
    }
}
