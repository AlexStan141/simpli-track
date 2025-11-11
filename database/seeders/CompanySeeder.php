<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::factory()->create([
            'name' => 'Starbucks',
            'logo' => 'company_logos/Starbucks.png',
            'address' => 'Address 1'
        ]);
        Company::factory()->create([
            'name' => 'Facebook',
            'logo' => 'company_logos/Facebook.png',
            'address' => 'Address 2'
        ]);
        Company::factory()->create([
            'name' => 'Sportano',
            'logo' => 'company_logos/Sportano.png',
            'address' => 'Address 3'
        ]);
        Company::factory()->create([
            'name' => 'SimpliTrack',
            'logo' => 'company_logos/SimpliTrack.png',
            'address' => 'Address 4'
        ]);
    }
}
