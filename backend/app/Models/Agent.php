<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Relationships imports
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\Review;

class Agent extends Model
{
    protected $fillable = [
        'store_name',
        'latitude',
        'longitude',
        'commission_rate',
        'is_approved',
        'working_hour',
        'user_id',
    ];

    // Relationships

    // Each agent belongs to only one user
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Each agent could have many reviews
    public function reviews() {
        return $this->hasMany(Review::class);
    }

}
