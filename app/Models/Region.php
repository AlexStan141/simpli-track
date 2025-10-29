<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{
    /** @use HasFactory<\Database\Factories\RegionFactory> */
    use HasFactory;

    public function countries(): HasMany{
        return $this->hasMany(Country::class);
    }

    public function companies(): BelongsToMany{
        return $this->belongsToMany(Company::class)->withTimestamps();
    }

    public function invoice_templates(): HasMany{
        return $this->hasMany(InvoiceTemplate::class);
    }
}
