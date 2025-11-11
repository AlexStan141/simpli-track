<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::factory()->create([
            'name' => 'Pending'
        ]);
        Status::factory()->create([
            'name' => 'Paid'
        ]);
        Status::factory()->create([
            'name' => 'Entered'
        ]);
        Status::factory()->create([
            'name' => 'Validate'
        ]);
        Status::factory()->create([
            'name' => 'Missing'
        ]);
        Status::factory()->create([
            'name' => 'Overdue'
        ]);
        Status::factory()->create([
            'name' => 'Dispute'
        ]);
        Status::factory()->create([
            'name' => 'Reconcile'
        ]);
    }
}
