<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Relationships imports
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Agent;

class Review extends Model
{
    protected $fillable = [
        'rating',
        'comment',
        'user_id',
        'agent_id',
    ];

    // Relationships

    // Each review is submitted by one user
    public function user() {
        return $this->belongsTo(User::class);    
    }

    // Each review is assigned to one agent
    public function agent() {
        return $this->belongsTo(Agent::class);
    }
}
