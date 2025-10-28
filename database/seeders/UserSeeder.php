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
        $simpli_track_company = Company::where('name',  'SimpliTrack')->first();

        User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
            'role' => 'Admin',
            'phone' => '+40729626513',
            'company_id' => $simpli_track_company->id
        ]);

        for ($i = 0; $i < 4; $i++) {
            User::factory(10)->create([
                'role' => 'User',
                'company_id' => $companies->last()->id
            ]);

            User::factory(2)->create([
                'role' => 'Lease Admin',
                'company_id' => $companies->last()->id
            ]);

            User::factory(2)->create([
                'role' => 'Portofolio Manager',
                'company_id' => $companies->last()->id
            ]);

            User::factory(2)->create([
                'role' => 'Director',
                'company_id' => $companies->last()->id
            ]);
            $companies->pop();
        }
    }
}
