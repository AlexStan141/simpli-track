<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    /** @use HasFactory<\Database\Factories\StatusFactory> */
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function bills(){
        return $this->hasMany(Bill::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    protected static function booted()
    {
        static::deleting(function($status){
            if(!$status->isForceDeleting()){
                $status->bills()->get()->each->delete();
            }
        });

        static::restoring(function ($status) {
            $status->bills()->withTrashed()->get()->each->restore();
        });
    }
}
