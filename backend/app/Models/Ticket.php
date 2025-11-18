<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Relationships imports
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Ticket extends Model
{
    protected $fillable = [
        'subject',
        'description',
        'status',
        'user_id',
    ];

    // Relationships

    // Each ticket is submitted by one User
    public function submittedBy() {
        return $this->belongsTo(User::class);
    }
}
