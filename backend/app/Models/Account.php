<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Relationships imports
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\Currency;
use App\Models\Transaction;

class Account extends Model
{
    protected $fillable = [
        'account_number',
        'balance',
        'status',
        'user_id',
        'currency_id',
    ];

    // Relationships

    // Each acount belongs to only one user
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Each account is in one currency
    public function currency() {
        return $this->belongsTo(Currency::class);
    }

    // Each account is the sender account of many transactions
    public function sentTransactions() {
        return $this->hasMany(Transaction::class, 'sender_account_id');
    }

    // Each account is the receiver account of many transactions
    public function receivedTransactions() {
        return $this->hasMany(Transaction::class, 'receiver_account_id');
    }
}
