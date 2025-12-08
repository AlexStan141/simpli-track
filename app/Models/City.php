<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    /** @use HasFactory<\Database\Factories\CityFactory> */
    use HasFactory;
    protected $guarded = [];

    public function country(): BelongsTo{
        return $this->belongsTo(Country::class);
    }

    public function company(){
        return $this->hasOne(Company::class);
    }

    public function invoice_templates(): HasMany{
        return $this->hasMany(InvoiceTemplate::class);
    }
}
