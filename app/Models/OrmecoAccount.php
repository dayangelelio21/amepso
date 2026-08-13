<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrmecoAccount extends Model
{
    protected $fillable = [
        'user_id',
        'account_number',
        'account_name',
        'meter_number',
        'service_address',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bills(): HasMany
    {
        return $this->hasMany(OrmecoBill::class);
    }
}