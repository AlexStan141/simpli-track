<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    /** @use HasFactory<\Database\Factories\BillFactory> */
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function invoice_template(){
        return $this->belongsTo(InvoiceTemplate::class);
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function note()
    {
        return $this->hasOne(Note::class);
    }

    protected static function booted()
    {
        static::deleting(function($bill){
            if(!$bill->isForceDeleting()){
                if($bill->note){
                    $bill->note->delete();
                }
            }
        });

        static::restoring(function ($bill) {
            if($bill->note){
                $bill->note->restore();
            }
        });
    }
}
