<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Account;
use App\Models\Transaction;

class Currency extends Model
{
    protected $fillable = [
        'code',
        'name',
        'exchange_rate',
    ];

    // Relationships

    // Each currency could be the currency of many accounts
    public function accounts() {
        return $this->hasMany(Account::class);
    }

    // Each currency could be used in many transaction
    public function transactions() {
        return $this->hasMany(Transaction::class);
    }
}
