<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DueDay extends Model
{
    /** @use HasFactory<\Database\Factories\DueDayFactory> */
    use HasFactory, SoftDeletes;

    public function invoice_templates(): HasMany {
        return $this->hasMany(InvoiceTemplate::class);
    }

    protected static function booted()
    {
        static::deleting(function($due_day){
            if(!$due_day->isForceDeleting()){
                $due_day->invoice_templates()->get()->each->delete();
            }
        });

        static::restoring(function ($due_day) {
            $due_day->invoice_templates()->withTrashed()->get()->each->restore();
        });
    }

    protected $table = 'due_days';

}
