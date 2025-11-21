<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    /** @use HasFactory<\Database\Factories\BillFactory> */
    use HasFactory;

    protected $guarded = [];

    public function invoice_template(){
        return $this->belongsTo(InvoiceTemplate::class);
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }
}
