<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrmecoBill extends Model
{
    protected $fillable = [
        'ormeco_account_id',
        'bill_number',
        'amount',
        'billing_date',
        'due_date',
        'status',
        'paid_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'billing_date' => 'date',
        'due_date' => 'date',
        'paid_at' => 'datetime',
    ];

    public function ormecoAccount(): BelongsTo
    {
        return $this->belongsTo(OrmecoAccount::class);
    }
}