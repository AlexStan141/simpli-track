<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceForAttention extends Model
{
    /** @use HasFactory<\Database\Factories\InvoiceForAttentionFactory> */
    use HasFactory, SoftDeletes;

    public function invoice_templates(): HasMany {
        return $this->hasMany(InvoiceTemplate::class);
    }

    protected static function booted()
    {
        static::deleting(function($invoice_for_attention){
            if(!$invoice_for_attention->isForceDeleting()){
                $invoice_for_attention->invoice_templates()->get()->each->delete();
            }
        });

        static::restoring(function ($invoice_for_attention) {
            $invoice_for_attention->invoice_templates()->withTrashed()->get()->each->restore();
        });
    }
}
