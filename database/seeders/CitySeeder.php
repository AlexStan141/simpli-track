<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\City;
use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = Country::all();

        for($i = 0; $i < 9; $i++){
            $country = $countries->pop();
            City::factory(3)->create([
                'country_id' => $country->id,
                'company_id' => Company::all()->first()->id
            ]);
        }
    }
}
