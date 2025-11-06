<?php

namespace Database\Seeders;

use App\Models\Category;
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
        DB::table('categories')->truncate();
        Category::factory()->create([
            'name' => 'Rent'
        ]);
        Category::factory()->create([
            'name' => 'CAM'
        ]);
        Category::factory()->create([
            'name' => 'Parking'
        ]);
        Category::factory()->create([
            'name' => 'CAM Reconciliation'
        ]);
        Category::factory()->create([
            'name' => 'Taxes'
        ]);
        Category::factory()->create([
            'name' => 'Insurance'
        ]);
    }
}
