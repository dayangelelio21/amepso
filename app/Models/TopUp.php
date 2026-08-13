<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TopUp extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'reference',
        'provider',
        'provider_reference',
        'status',
        'paid_at',
        'credited_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'paid_at' => 'datetime',
        'credited_at' => 'datetime',
    ];

    /**
     * The user who created the top-up.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}