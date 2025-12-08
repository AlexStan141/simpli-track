<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Country;
use App\Models\Region;
use Database\Factories\CountryFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = Region::all();

        for($i = 0; $i < 3; $i++){
            $region = $regions->pop();
            Country::factory(3)->create([
                'region_id' => $region->id
            ]);
        }
    }
}
