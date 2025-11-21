<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    /** @use HasFactory<\Database\Factories\CompanyFactory> */
    use HasFactory;

    protected $guarded = [];

    public function users(): HasMany{
        return $this->hasMany(User::class);
    }

    public function regions(): HasMany{
        return $this->hasMany(Region::class);
    }

    public function countries(): HasMany{
        return $this->hasMany(Country::class);
    }

    public function cities(): HasMany{
        return $this->hasMany(City::class);
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
}
