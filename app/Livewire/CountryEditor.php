<?php

namespace App\Livewire;

use App\Models\Country;
use Livewire\Component;

class CountryEditor extends Component
{
    public $old_country;
    public $country_id;
    public $editMode = false;
    public $new_country;

    public function mount($old_country, $country_id)
    {
        $this->old_country = $old_country;
        $this->new_country = $old_country;
        $this->country_id = $country_id;
    }

    public function saveCountry()
    {
        $country = Country::find($this->country_id);
        $country->name = $this->new_country;
        $country->save();

        $this->old_country = $this->new_country;
        $this->editMode = false;
    }

    public function deleteCountry()
    {
        $country = Country::find($this->country_id);
        $country->company_id = null;
        $country->save();
        $this->dispatch('statusDeleted');
    }

    public function editCountry()
    {
        $this->editMode = true;
    }

    public function render()
    {
        return view('livewire.country-editor');
    }
}
