<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\City;
use App\Models\Status;
use App\Models\User;
use App\Models\Region;
use App\Models\Country;
use App\Models\DueDay;
use App\Models\InvoiceForAttention;
use App\Models\InvoiceTemplate;
use App\Models\Landlord;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('invoice_templates')->truncate();
        $categories = Category::all();
        $statuses = Status::all();
        $users = User::all();
        $regions = Region::all();
        $countries = Country::all();
        $cities = City::all();
        $landlords = Landlord::all();
        $dueDates = DueDay::all();
        $invoicesForAttention = InvoiceForAttention::all();

        foreach ($users as $user) {
            for ($i = 1; $i <= 20; $i++) {
                $category = $categories->random();
                $status = $statuses->random();
                $region = $regions->random();
                $country = $countries->random();
                $city = $cities->random();
                $landlord = $landlords->random();
                $dueDate = $dueDates->random();
                $invoiceForAttention = $invoicesForAttention->random();
                InvoiceTemplate::factory()->create([
                    'category_id' => $category->id,
                    'status_id' => $status->id,
                    'user_id' => $user->id,
                    'region_id' => $region->id,
                    'country_id' => $country->id,
                    'city_id' => $city->id,
                    'landlord_id' => $landlord->id,
                    'due_day_id' => $dueDate->id,
                    'invoice_for_attention_id' => $invoiceForAttention->id
                ]);
            }
        }
    }
}
