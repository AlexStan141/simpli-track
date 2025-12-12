<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function invoice_templates(): HasMany{
        return $this->hasMany(InvoiceTemplate::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    protected static function booted()
    {
        static::deleting(function($category){
            if(!$category->isForceDeleting()){
                $category->invoice_templates()->get()->each->delete();
            }
        });

        static::restoring(function ($category) {
            //$invoice->bills()->restore();
            $category->invoice_templates()->withTrashed()->get()->each->restore();
        });
    }
}
