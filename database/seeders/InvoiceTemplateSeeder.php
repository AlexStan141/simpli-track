<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\City;
use App\Models\Status;
use App\Models\User;
use App\Models\Region;
use App\Models\Country;
use App\Models\InvoiceTemplate;
use App\Models\Landlord;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        $statuses = Status::all();
        $users = User::all();
        $regions = Region::all();
        $countries = Country::all();
        $cities = City::all();
        $landlords = Landlord::all();

        foreach($users as $user){
            $category = $categories->random();
            $status = $statuses->random();
            $region = $regions->random();
            $country = $countries->random();
            $city = $cities->random();
            $landlord = $landlords->random();
            InvoiceTemplate::factory(20)->create([
                'category_id' => $category->id,
                'status_id' => $status->id,
                'user_id' => $user->id,
                'region_id' => $region->id,
                'country_id' => $country->id,
                'city_id' => $city->id,
                'landlord_id' => $landlord->id
            ]);
        }
    }
}
