<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\CompanyRegion;
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
            foreach($regions as $region){
                CompanyRegion::factory()->create([
                    'company_id' => $company->id,
                    'region_id' => $region->id
                ]);
            }
        }
    }
}
