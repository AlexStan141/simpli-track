<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Region;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Region::factory()->create([
            'name' => 'AMER',
            'company_id' => 1
        ]);
        Region::factory()->create([
            'name' => 'EMEA',
            'company_id' => 1
        ]);
        Region::factory()->create([
            'name' => 'APAC',
            'company_id' => 1
        ]);
    }
}
