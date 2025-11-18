<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Beneficiary extends Model
{
    protected $fillable = [
        'receipant_name',
        'receipant_account_number',
        'user_id'
    ];

    // Relationships

    // Each beneficiary belongs to only one user
    public function user() {
        return $this->belongsTo(User::class);
    }
}
