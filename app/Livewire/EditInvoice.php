<?php

namespace App\Livewire;

use App\Http\Requests\InvoiceRequest;
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
    public $selected_status = 1;
    public $lease_no;
    public $amount;
    public $currencies;
    public $selected_currency;
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
    public $frequency_options = ['Monthly', 'Quarterly'];
    public $selected_frequency;

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
            $this->selected_frequency = 'Monthly';
        } else {
            $this->selected_frequency = 'Quarterly';
        }
    }

    public function deleteInvoiceTemplate($initialInvoice)
    {
        $initialInvoiceAsObject = InvoiceTemplate::findOrFail($initialInvoice['id']);
        $initialInvoiceAsObject->delete();
        return redirect()->to(route('invoice.index'))->with('success', 'Invoice template deleted successfully.');
    }

    public function editInvoiceTemplate($initialInvoice)
    {
        $initialInvoiceAsObject = InvoiceTemplate::findOrFail($initialInvoice['id']);
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
            'selected_currency' => 'required',
            'selected_frequency' => ['required', Rule::in(['Monthly', 'Quarterly'])],
            'lease_no' => ['required', 'string', 'max:50'],
            'amount' => ['required', 'integer', 'min:100', 'max:5000'],
        ]);

        $initialInvoiceAsObject->fill([
            'frequency' => $this->selected_frequency,
            'amount' => $this->amount,
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
            'currency_id' => $this->selected_currency,
            "last_time_paid" => $this->last_time_paid,
        ]);
        $initialInvoiceAsObject->save();
        return redirect()->to(route('invoice.edit', [
            'initialInvoice' => $initialInvoiceAsObject
        ]))->with('success', 'Invoice template edited successfully.');
    }

    public function mount(){
        $this->categories = Category::pluck('name', 'id');
        $this->selected_category = $this->initialInvoice->category_id;

        $this->lease_no = $this->initialInvoice->lease_no;

        $this->amount = $this->initialInvoice->amount;
        $this->currencies = Currency::pluck('name', 'id');
        $this->selected_currency = $this->initialInvoice->currency_id;

        $this->users = User::get()->mapWithKeys(fn($user) => [$user->id => $user->full_name]);
        $this->selected_user = $this->initialInvoice->user_id;

        $this->regions = Region::pluck('name', 'id');
        $this->selected_region = $this->initialInvoice->region_id;

        $this->countries = Country::pluck('name', 'id');
        $this->selected_country = $this->initialInvoice->country_id;

        $this->cities = City::pluck('name', 'id');
        $this->selected_city = $this->initialInvoice->city_id;

        $this->landlords = Landlord::pluck('name', 'id');
        $this->selected_landlord = $this->initialInvoice->landlord_id;

        $this->due_days = DueDay::pluck('day', 'id');
        $this->selected_due_day = $this->initialInvoice->due_day_id;

        $this->invoices_for_attention = InvoiceForAttention::pluck('period', 'id');
        $this->selected_invoice_for_attention = $this->initialInvoice->invoice_for_attention_id;

        $this->selected_frequency = $this->initialInvoice->frequency;

        $date = new DateTime();
        $date->modify('-1 month');
        $year = date_format($date, 'Y');
        $month = date_format($date, 'n');
        $day = (int) $this->selected_due_day;
        $date->setDate($year, $month, $day);
        $this->last_time_paid = $date;
    }
}
