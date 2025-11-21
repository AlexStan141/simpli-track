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
            'name' => 'Pending',
            'company_id' => 1
        ]);
        Status::factory()->create([
            'name' => 'Paid',
            'company_id' => 1
        ]);
        Status::factory()->create([
            'name' => 'Entered',
            'company_id' => 1
        ]);
        Status::factory()->create([
            'name' => 'Validate',
            'company_id' => 1
        ]);
        Status::factory()->create([
            'name' => 'Missing',
            'company_id' => 1
        ]);
        Status::factory()->create([
            'name' => 'Overdue',
            'company_id' => 1
        ]);
        Status::factory()->create([
            'name' => 'Dispute',
            'company_id' => 1
        ]);
        Status::factory()->create([
            'name' => 'Reconcile',
            'company_id' => 1
        ]);
    }
}
