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
            'name' => 'SimpliTrack',
            'logo' => 'company_logos/SimpliTrack.png',
            'currency_id' => 1,
            'due_day_id' => 1,
            'invoice_for_attention_id' => 1,
            'address' => 'Address 4'
        ]);
    }
}
