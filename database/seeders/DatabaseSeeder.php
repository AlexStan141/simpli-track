<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CurrencySeeder::class);
        $this->call(DueDaySeeder::class);
        $this->call(InvoiceForAttentionSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RegionSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(CitySeeder::class);
        $this->call(LandlordSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(CompanyRegionSeeder::class);
        $this->call(InvoiceTemplateSeeder::class);
    }
}
