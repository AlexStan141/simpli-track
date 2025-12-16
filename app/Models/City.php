<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    /** @use HasFactory<\Database\Factories\CityFactory> */
    use HasFactory, SoftDeletes;
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

    protected static function booted()
    {
        static::deleting(function($city){
            if(!$city->isForceDeleting()){
                $city->invoice_templates()->get()->each->delete();
                $city->company->delete();
            }
        });

        static::restoring(function ($city) {
            $city->invoice_templates()->withTrashed()->get()->each->restore();
            $city->company->restore();
        });
    }
}
