<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Landlord extends Model
{
    /** @use HasFactory<\Database\Factories\LandlordFactory> */
    use HasFactory, SoftDeletes;

    public function invoice_templates(): HasMany{
        return $this->hasMany(InvoiceTemplate::class);
    }

    protected static function booted()
    {
        static::deleting(function($landlord){
            if(!$landlord->isForceDeleting()){
                // $invoice->bills()->delete(); hard delete
                $landlord->invoice_templates()->get()->each->delete();
            }
        });

        static::restoring(function ($landlord) {
            //$invoice->bills()->restore();
            $landlord->invoice_templates()->withTrashed()->get()->each->restore();
        });
    }
}
