<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies_ids = Company::all()->pluck('id');

        foreach ($companies_ids as $company_id) {
            Category::factory()->create([
                'name' => 'Rent',
                'company_id' => $company_id
            ]);
            Category::factory()->create([
                'name' => 'CAM',
                'company_id' => $company_id
            ]);
            Category::factory()->create([
                'name' => 'Parking',
                'company_id' => $company_id
            ]);
            Category::factory()->create([
                'name' => 'CAM Reconciliation',
                'company_id' => $company_id
            ]);
            Category::factory()->create([
                'name' => 'Taxes',
                'company_id' => $company_id
            ]);
            Category::factory()->create([
                'name' => 'Insurance',
                'company_id' => $company_id
            ]);
        }
    }
}
