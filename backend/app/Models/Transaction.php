<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Relationships imports
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Account;
use App\Models\PaymentMethod;
use App\Models\Currency;

class Transaction extends Model
{
    protected $fillable = [
        'amount',
        'fee',
        'status',
        'reference_code',
        'transaction_typ',
        'refund_reason',
        'refund_status',
        'refund_approved_by',
        'sender_account_id',
        'receiver_account_id',
        'currency_id',
        'payment_method_id',
    ];

    // Relationships

    // Each transaction is done in only one currency
    public function currency() {
        return $this->belongsTo(Currency::class);
    }

    // Each transaction use only one payment method
    public function paymentMethod() {
        return $this->belongsTo(PaymentMethod::class);
    }

    // Each transaction has only one sender account
    public function senderAccount() {
        return $this->belongsTo(Account::class, 'sender_account_id');
    }

    // Each transaction has only one receiver account
    public function receiverAccount() {
        return $this->belongsTo(Account::class, 'receiver_account_id');
    }

    // Each transactiob refund request is approved by only one user
    public function refundApprovedBy() {
        return $this->belongsTo(User::class, 'refund_approved_by');
    }
}
