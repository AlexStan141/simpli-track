<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    /** @use HasFactory<\Database\Factories\CountryFactory> */
    use HasFactory;

    protected $guarded = [];

    public function region(): BelongsTo{
        return $this->belongsTo(Region::class);
    }

    public function cities(): HasMany{
        return $this->hasMany(City::class);
    }

    public function company(){
        return $this->hasOne(Company::class);
    }

    public function currency(){
        return $this->hasOne(Currency::class);
    }

    public function invoice_templates(): HasMany{
        return $this->hasMany(InvoiceTemplate::class);
    }
}
