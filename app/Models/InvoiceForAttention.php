<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InvoiceForAttention extends Model
{
    /** @use HasFactory<\Database\Factories\InvoiceForAttentionFactory> */
    use HasFactory;

    public function invoice_templates(): HasMany {
        return $this->hasMany(InvoiceTemplate::class);
    }
}
