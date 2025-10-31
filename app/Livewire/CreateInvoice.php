<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\DueDay;
use App\Models\InvoiceForAttention;
use App\Models\Region;
use App\Models\User;
use App\Models\Landlord;
use Livewire\Component;

class CreateInvoice extends Component
{
    public $categories;
    public $selected_category;
    public $users;
    public $selected_user;
    public $regions;
    public $selected_region;
    public $countries;
    public $selected_country;
    public $cities;
    public $selected_city;
    public $landlords;
    public $selected_landlord;
    public $lease_no;
    public $due_days;
    public $selected_due_day;
    public $invoices_for_attention;
    public $selected_invoice_for_attention;

    public function updatedSelectedRegion($value)
    {
        $this->updateCountryList();
    }
    public function updatedSelectedCountry($value)
    {
        $this->updateCityList();
    }
    public function updateCountryList()
    {
        $this->countries = Country::where('region_id', $this->selected_region)->pluck('name', 'id');
        $this->selected_country = $this->countries->keys()->first();
        $this->updateCityList();
    }

    public function updateCityList()
    {
        $this->cities = City::where('country_id', $this->selected_country)->pluck('name', 'id');
        $this->selected_city = $this->cities->keys()->first();
    }

    public function mount()
    {
        // Categorii
        $this->categories = Category::pluck('name', 'id');
        $this->selected_category = $this->categories->keys()->first();

        // Utilizatori
        $this->users = User::get()->mapWithKeys(fn($user) => [$user->id => $user->full_name]);
        $this->selected_user = $this->users->keys()->first();

        // Regiuni
        $this->regions = Region::pluck('name', 'id');
        $this->selected_region = $this->regions->keys()->first();
        $this->updateCountryList();

        // Proprietari
        $this->landlords = Landlord::pluck('name', 'id');
        $this->selected_landlord = $this->landlords->keys()->first();

        $this->due_days = DueDay::pluck('day', 'id');
        $this->selected_due_day = $this->due_days->keys()->first();

        $this->invoices_for_attention = InvoiceForAttention::pluck('period', 'id');
        $this->selected_invoice_for_attention = $this->invoices_for_attention->keys()->first();
    }

    public function render()
    {
        return view('livewire.create-invoice');
    }
}
