<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// Relationships imports
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Agent;
use App\Models\Role;
use App\Models\UserBiometric;
use App\Models\Account;
use App\Models\Beneficiary;
use App\Models\PaymentMethod;
use App\Models\Ticket;
use App\Models\Review;
use App\Models\Transaction;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone_number',
        'is_verified',
        'role_id',
    ];

    // Relationships

    // Each user has one role
    public function role() {
        return $this->belongsTo(Role::class);
    }

    // Each user has one agent
    public function agent() {
        return $this->hasOne(Agent::class);
    }

    // Each user has one user biometrics profile
    public function biometric() {
        return $this->hasOne(UserBiometric::class);
    }

    // Each user could have many accounts
    public function accounts() {
        return $this->hasMany(Account::class);
    }

    // Each user could have many beneficiaries
    public function beneficiaries() {
        return $this->hasMany(Beneficiary::class);
    }

    // Each user could have many payment methods
    public function paymentMethods() {
        return $this->hasMany(PaymentMethod::class);
    }

    // Each user could send many tickets
    public function submittedTickets() {
        return $this->hasMany(Ticket::class);
    }

    // Each use could do many reviews
    public function submittedReviews() {
        return $this->hasMany(Review::class);
    }

    // Each user could approve many transactions (For Admins Only)
    public function approvedRefunds() {
        return $this->hasMany(Transaction::class, 'refund_approved_by');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
