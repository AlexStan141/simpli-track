<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    /** @use HasFactory<\Database\Factories\CompanyFactory> */
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function users(): HasMany{
        return $this->hasMany(User::class);
    }

    public function regions(){
        return $this->belongsToMany(Region::class);
    }

    public function countries(){
        return $this->belongsToMany(Country::class);
    }

    public function cities(){
        return $this->belongsToMany(City::class);
    }

    public function landlords(): HasMany{
        return $this->hasMany(Landlord::class);
    }

    public function categories(){
        return $this->hasMany(Category::class);
    }

    public function statuses(){
        return $this->hasMany(Status::class);
    }

    public function currency(): BelongsTo{
        return $this->belongsTo(Currency::class);
    }

    public function due_day(): BelongsTo{
        return $this->belongsTo(DueDay::class);
    }

    public function invoice_for_attention(): BelongsTo{
        return $this->belongsTo(InvoiceForAttention::class);
    }

    protected static function booted()
    {
        static::deleting(function($company){
            if(!$company->isForceDeleting()){
                $company->users()->get()->each->delete();
                $company->landlords()->get()->each->delete();
                $company->categories()->get()->each->delete();
                $company->statuses()->get()->each->delete();
            }
        });

        static::restoring(function ($company) {
            $company->users()->withTrashed()->get()->each->restore();
            $company->landlords()->withTrashed()->get()->each->restore();
            $company->categories()->withTrashed()->get()->each->restore();
            $company->statuses()->withTrashed()->get()->each->restore();
        });
    }
}
