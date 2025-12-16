<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    /** @use HasFactory<\Database\Factories\RolesFactory> */
    use HasFactory, SoftDeletes;

    public function users(): HasMany{
        return $this->hasMany(User::class);
    }

    protected static function booted()
    {
        static::deleting(function($role){
            if(!$role->isForceDeleting()){
                $role->users()->get()->each->delete();
            }
        });

        static::restoring(function ($role) {
            $role->users()->withTrashed()->get()->each->restore();
        });
    }
}
