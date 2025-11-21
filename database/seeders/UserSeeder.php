<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Role;
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
        $company = Company::all()->first();

        for ($i = 0; $i < 4; $i++) {

            User::factory(10)->create([
                'role_id' => Role::where('name', 'User')->first()->id,
                'company_id' => $company->id
            ]);

            User::factory(2)->create([
                'role_id' => Role::where('name', 'Lease Admin')->first()->id,
                'company_id' => $company->id
            ]);

            User::factory(2)->create([
                'role_id' => Role::where('name', 'Portofolio Manager')->first()->id,
                'company_id' => $company->id
            ]);

            User::factory(2)->create([
                'role_id' => Role::where('name', 'Director')->first()->id,
                'company_id' => $company->id
            ]);

            User::factory()->create([
                'role_id' => Role::where('name', 'Admin')->first()->id,
                'company_id' => $company->id
            ]);
        }
    }
}
