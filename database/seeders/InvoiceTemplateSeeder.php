<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\City;
use App\Models\User;
use App\Models\Region;
use App\Models\Country;
use App\Models\Currency;
use App\Models\DueDay;
use App\Models\InvoiceForAttention;
use App\Models\InvoiceTemplate;
use App\Models\Landlord;
use Illuminate\Database\Seeder;

class InvoiceTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        $users = User::all();
        $regions = Region::all();
        $landlords = Landlord::all();
        $dueDates = DueDay::all();
        $currencies = Currency::all();
        $invoicesForAttention = InvoiceForAttention::all();

        foreach ($users as $user) {
            for ($i = 1; $i <= 3; $i++) {
                $category = $categories->random();
                $region = $regions->random();
                $countries = Country::where('region_id', $region->id)->get();
                $country = $countries->random();
                $cities = City::where('country_id', $country->id)->get();
                $city = $cities->random();
                $landlord = $landlords->random();
                $dueDate = $dueDates->random();
                $invoiceForAttention = $invoicesForAttention->random();
                $currency = $currencies->random();
                InvoiceTemplate::factory()->create([
                    'category_id' => $category->id,
                    'user_id' => $user->id,
                    'region_id' => $region->id,
                    'country_id' => $country->id,
                    'city_id' => $city->id,
                    'landlord_id' => $landlord->id,
                    'due_day_id' => $dueDate->id,
                    'currency_id' => $currency->id,
                    'invoice_for_attention_id' => $invoiceForAttention->id,
                ]);
            }
        }
    }
}
