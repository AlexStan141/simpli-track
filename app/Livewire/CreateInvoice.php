<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\City;
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

class CreateInvoice extends Component
{
    protected $listeners = [
        'setCurrencyInInvoiceForm' => 'setCurrency',
    ];
    public $amount;
    public $currencies;
    public $currency;
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
    public $selected_status = 1;
    public $selected_due_day;
    public $last_time_paid;
    public $invoices_for_attention;
    public $selected_invoice_for_attention;
    public $frequency_options = ['monthly', 'quarterly'];
    public $selected_frequency = 'monthly';
    public $newOneCreated;
    public function setCurrency($payload){
        $this->currency = $payload['currency'];
    }
    public function updatedSelectedRegion($value)
    {
        $this->updateCountryList();
    }

    public function updatedSelectedDueDay($value){
        $this->updateLastTimePaid();
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
        $company = Auth::user()->company;

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
        $this->selected_due_day = $company->due_day_id;

        $this->invoices_for_attention = InvoiceForAttention::pluck('period', 'id');
        $this->selected_invoice_for_attention = $company->invoice_for_attention_id;

        $this->currencies = Currency::pluck('name');
        $this->currency = Auth::user()->company->currency->name;

        $date = new DateTime();
        $date->modify('-1 month');
        $year = date_format($date, 'Y');
        $month = date_format($date, 'n');
        $day = (int) $this->selected_due_day;
        $date->setDate($year, $month, $day);
        $this->last_time_paid = $date;

        $this->newOneCreated = false;
    }

    public function createInvoiceTemplate(){

        $this->validate([
            'selected_due_day' => 'required',
            'selected_invoice_for_attention' => 'required',
            'selected_category' => 'required',
            'selected_user' => 'required',
            'selected_status' => 'required',
            'selected_region' => 'required',
            'selected_country' => 'required',
            'selected_city' => 'required',
            'last_time_paid' => 'required',
            'selected_frequency' => ['required', Rule::in(['monthly', 'quarterly'])],
            'lease_no' => ['required', 'string', 'max:50']
        ]);

        InvoiceTemplate::create([
            'frequency' => $this->selected_frequency,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'lease_no' => $this->lease_no,
            'due_day_id' => $this->selected_due_day,
            'invoice_for_attention_id' => $this->selected_invoice_for_attention,
            'category_id' => $this -> selected_category,
            "status_id" => $this->selected_status,
            "user_id" => $this->selected_user,
            "region_id" => $this->selected_region,
            "country_id" => $this->selected_country,
            "city_id" => $this->selected_city,
            "landlord_id" => $this->selected_landlord,
            "last_time_paid" => $this->last_time_paid
        ]);
        $this->dispatch('invoiceTemplateCreated');
        $this->newOneCreated = true;
    }

    public function render()
    {
        return view('livewire.create-invoice');
    }
}
