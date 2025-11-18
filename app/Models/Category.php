<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    public function invoice_templates(): HasMany{
        return $this->hasMany(InvoiceTemplate::class);
    }

    public function category_users(): HasMany{
        return $this->hasMany(CategoryUser::class);
    }
}
