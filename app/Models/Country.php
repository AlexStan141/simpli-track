<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    /** @use HasFactory<\Database\Factories\CountryFactory> */
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function region(): BelongsTo{
        return $this->belongsTo(Region::class)->withTrashed();
    }

    public function cities(): HasMany{
        return $this->hasMany(City::class);
    }

    public function company(){
        return $this->hasOne(Company::class);
    }

    public function currency(){
        return $this->belongsTo(Currency::class)->withTrashed();
    }

    public function invoice_templates(): HasMany{
        return $this->hasMany(InvoiceTemplate::class);
    }

    protected static function booted()
    {
        static::deleting(function($country){
            if(!$country->isForceDeleting()){
                $country->invoice_templates()->get()->each->delete();
                $country->cities()->get()->each->delete();
            }
        });

        static::restoring(function ($country) {
            $country->invoice_templates()->withTrashed()->get()->each->restore();
            $country->cities()->withTrashed()->get()->each->restore();
        });
    }
}
