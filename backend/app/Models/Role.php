<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Relationships imports
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;

class Role extends Model
{
    protected $fillable = [
        'name',
    ];

    // Relationships

    // Each role could be assigned to many users
    public function assignedUsers() {
        return $this->hasMany(User::class);
    }
}
