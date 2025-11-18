<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Relationships imports
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class UserBiometric extends Model
{
    protected $fillable = [
    'face_image_path',
    'verification_status',
    'user_id',
    ];

    // Relationships

    // Each biometrics are for only one user
    public function user() {
        return $this->belongsTo(User::class);
    }
}
