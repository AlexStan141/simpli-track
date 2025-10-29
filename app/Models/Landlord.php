<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Landlord extends Model
{
    /** @use HasFactory<\Database\Factories\LandlordFactory> */
    use HasFactory;

    public function invoice_templates(): HasMany{
        return $this->hasMany(InvoiceTemplate::class);
    }
}
