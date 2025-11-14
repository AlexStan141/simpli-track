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
            'currency_id' => 1,
            'due_day_id' => 1,
            'invoice_for_attention_id' => 1,
            'address' => 'Address 1'
        ]);
        Company::factory()->create([
            'name' => 'Facebook',
            'logo' => 'company_logos/Facebook.png',
            'currency_id' => 1,
            'due_day_id' => 1,
            'invoice_for_attention_id' => 1,
            'address' => 'Address 2'
        ]);
        Company::factory()->create([
            'name' => 'Sportano',
            'logo' => 'company_logos/Sportano.png',
            'currency_id' => 1,
            'due_day_id' => 1,
            'invoice_for_attention_id' => 1,
            'address' => 'Address 3'
        ]);
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
