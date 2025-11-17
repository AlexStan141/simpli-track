<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\City;
use App\Models\Company;
use App\Models\Country;
use App\Models\Currency;
use App\Models\DueDay;
use App\Models\InvoiceForAttention;
use App\Models\InvoiceTemplate;
use App\Models\Region;
use App\Models\User;
use App\Models\Landlord;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Validation\Rule;

class EditInvoice extends Component
{
    public $initialInvoice;
    public $categories;
    public $selected_category;
    public $lease_no;
    public $amount;
    public $currencies;
    public $currency;
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
    public $due_days;
    public $selected_due_day;
    public $invoices_for_attention;
    public $selected_invoice_for_attention;
    public $last_time_paid;
    public $frequency_options = ['monthly', 'quarterly'];
    public $selected_frequency = 'monthly';

    public function updatedSelectedRegion($value)
    {
        $this->updateCountryList();
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

    public function updateLastTimePaid()
    {
        $date = new DateTime();
        $date->modify('-1 month');
        $year = date_format($date, 'Y');
        $month = date_format($date, 'n');
        $day = (int) $this->selected_due_day;
        $date->setDate($year, $month, $day);
        $this->last_time_paid = $date;
    }

    public function updateFrequency($option)
    {
        if($option == 0){
            $this->selected_frequency = 'monthly';
        } else {
            $this->selected_frequency = 'quarterly';
        }
    }

    public function mount(){
        $this->categories = Category::pluck('name', 'id');
        $this->selected_category = Category::find($this->initialInvoice->category_id)->name;

        $this->lease_no = $this->initialInvoice->lease_no;

        $this->amount = $this->initialInvoice->amount;
        $this->currencies = Currency::pluck('name', 'id');

        $user = User::find($this->initialInvoice->user_id);
        $company = Company::find($user->company_id);
        $this->currency = Currency::find($company->currency_id)->name;

        $this->users = User::get()->mapWithKeys(fn($user) => [$user->id => $user->full_name]);
        $this->selected_user = User::find($this->initialInvoice->user_id)->getFullNameAttribute();

        $this->regions = Region::pluck('name', 'id');
        $this->selected_region = Region::find($this->initialInvoice->region_id)->name;

        $this->countries = Country::pluck('name', 'id');
        $this->selected_country = Country::find($this->initialInvoice->country_id)->name;

        $this->cities = City::pluck('name', 'id');
        $this->selected_city = City::find($this->initialInvoice->city_id)->name;

        $this->landlords = Landlord::pluck('name', 'id');
        $this->selected_landlord = Landlord::find($this->initialInvoice->landlord_id)->name;

        $this->due_days = DueDay::pluck('day', 'id');
        $this->selected_due_day = DueDay::find($this->initialInvoice->due_day_id)->day;

        $this->invoices_for_attention = InvoiceForAttention::pluck('period', 'id');
        $this->selected_invoice_for_attention = InvoiceForAttention::find($this->initialInvoice->invoice_for_attention_id)->period;
    }
}
