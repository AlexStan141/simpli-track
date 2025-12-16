<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceTemplate extends Model
{
    /** @use HasFactory<\Database\Factories\InvoiceTemplateFactory> */
    use HasFactory, SoftDeletes;

    public static array $frequencies = ['Monthly', 'Quarterly'];

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class); //for assignee
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function landlord(): BelongsTo
    {
        return $this->belongsTo(Landlord::class);
    }

    public function due_day(): BelongsTo
    {
        return $this->belongsTo(DueDay::class);
    }

    public function invoice_for_attention(): BelongsTo
    {
        return $this->belongsTo(InvoiceForAttention::class);
    }

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }
}
