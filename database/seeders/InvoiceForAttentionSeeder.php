<?php

namespace Database\Seeders;

use App\Models\InvoiceForAttention;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceForAttentionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function periodWithSuffix($i){
        if($i == 1 || $i == 21){
            return $i . ' day';
        }
        else {
            return $i . ' days';
        }
    }

    public function run(): void
    {
        for($i = 1; $i <= 28; $i++){
            InvoiceForAttention::factory()->create([
                'period' => $this->periodWithSuffix($i)
            ]);
        }
    }
}
