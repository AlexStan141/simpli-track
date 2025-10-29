<?php

namespace Database\Seeders;

use App\Models\Landlord;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LandlordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Landlord::factory(50)->create();
    }
}
