<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();

        for ($i = 0; $i < 4; $i++) {

            $company = $companies->pop();

            User::factory(10)->create([
                'role' => 'User',
                'company_id' => $company->id
            ]);

            User::factory(2)->create([
                'role' => 'Lease Admin',
                'company_id' => $company->id
            ]);

            User::factory(2)->create([
                'role' => 'Portofolio Manager',
                'company_id' => $company->id
            ]);

            User::factory(2)->create([
                'role' => 'Director',
                'company_id' => $company->id
            ]);

            User::factory()->create([
                'role' => 'Admin',
                'company_id' => $company->id
            ]);
        }
    }
}
