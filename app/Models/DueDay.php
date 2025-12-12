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

    protected $table = 'due_days';

}
