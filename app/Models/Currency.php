<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    /** @use HasFactory<\Database\Factories\CurrencyFactory> */
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function company() {
        return $this->hasOne(Company::class);
    }

    public function countries() {
        return $this->hasMany(Country::class);
    }

    public function invoiceTemplates(): HasMany {
        return $this->hasMany(InvoiceTemplate::class);
    }

    protected static function booted()
    {
        static::deleting(function($currency){
            if(!$currency->isForceDeleting()){
                $currency->countries()->get()->each->delete();
                $currency->invoiceTemplates()->get()->each->delete();
            }
        });

        static::restoring(function ($currency) {
            $currency->countries()->withTrashed()->get()->each->restore();
            $currency->invoiceTemplates()->withTrashed()->get()->each->restore();
        });
    }
}
