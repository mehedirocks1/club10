<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'bangla_name',
        'photo',
        'email',
        'password',
        'mobile_number',
        'dob',
        'nid',
        'gender',
        'blood_group',
        'education',
        'profession',
        'skills',
        'country',
        'division',
        'district',
        'thana',
        'address',
        'membership_type',
        'registration_fee',
        'terms_accepted',
        'role_id', // Use role_id instead of role field
        'status', // Assuming 'status' indicates whether the user is active
        'remember_token',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * @return string
     */
   public function getFullNameAttribute()
   {
       return $this->first_name . ' ' . $this->last_name;
   }
 /**
     * Get the role of the user.
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * Scope a query to only include active users.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1); // Assuming 'status' indicates whether the user is active
    }

    /**
     * Scope a query to only include users with a specific membership type.
     */
    public function scopeMembershipType($query, $membershipType)
    {
        return $query->where('membership_type', $membershipType);
    }

    /**
     * Send a password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\ResetPasswordNotification($token));
    }


}
