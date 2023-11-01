<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\PasswordRouteEnum;
use App\Models\Profil;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements CanResetPassword
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $guard_name = 'manager';

    public function __construct()
    {

    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'profil_id',
        'user_name',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'customer_id',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profil()
    {
        return $this->belongsTo(Profil::class);
    }

/**
 * Send a password reset notification to the user.
 *
 * @param  string  $token
 */
    public function sendPasswordResetNotification($token): void
    {
        $route = PasswordRouteEnum::UPDATE_PASSWORD_ROUTE->value;

        $url = env('SPA_URL') . $route . '?token=' . $token;

        $this->notify(new ResetPasswordNotification($url));
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

}
