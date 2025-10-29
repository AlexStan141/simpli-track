<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanyRegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $regions = Region::all();
        $companies = Company::all();

        foreach($companies as $company){
            $company->regions()->attach($regions->random(3)->pluck('id')->toArray());
        }

    }
}
