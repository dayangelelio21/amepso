<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrmecoAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'account_number',
        'account_name',
        'meter_number',
        'service_address',
    ];


    /**
     * AMEPSO user who owns this ORMECO account.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Bills belonging to this ORMECO account.
     */
    public function bills()
    {
        return $this->hasMany(\App\Models\OrmecoBill::class);
    }
}