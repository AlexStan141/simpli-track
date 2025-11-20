<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    protected $guarded = [];

    public function invoice_templates(): HasMany{
        return $this->hasMany(InvoiceTemplate::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }
}
