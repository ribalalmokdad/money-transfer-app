<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\Transaction;

class PaymentMethod extends Model
{
    protected $fillable = [
        'tokenized_id',
        'method_type',
        'user_id',
    ];

    // Relationships

    // Each payment method belongs to only one user
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Each payment method could be used in many transactions
    public function transactions() {
        return $this->hasMany(Transaction::class);
    }
}
