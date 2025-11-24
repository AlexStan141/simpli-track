<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    /** @use HasFactory<\Database\Factories\StatusFactory> */
    use HasFactory;

    protected $guarded = [];

    public function bills(){
        return $this->hasMany(Bill::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }
}
