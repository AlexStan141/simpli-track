<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Currency extends Model
{
    /** @use HasFactory<\Database\Factories\CurrencyFactory> */
    use HasFactory;

    public function company() {
        return $this->hasOne(Company::class);
    }

    public function country() {
        return $this->hasMany(Country::class);
    }

    public function invoiceTemplates(): HasMany {
        return $this->hasMany(InvoiceTemplate::class);
    }
}
