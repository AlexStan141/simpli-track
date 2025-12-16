<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Model
{
    /** @use HasFactory<\Database\Factories\RegionFactory> */
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function countries(): HasMany{
        return $this->hasMany(Country::class);
    }

    public function company(){
        return $this->hasOne(Company::class);
    }

    public function invoice_templates(): HasMany{
        return $this->hasMany(InvoiceTemplate::class);
    }

    protected static function booted()
    {
        static::deleting(function($region){
            if(!$region->isForceDeleting()){
                $region->countries()->get()->each->delete();
            }
        });

        static::restoring(function ($region) {
            $region->countries()->withTrashed()->get()->each->restore();
        });
    }
}
