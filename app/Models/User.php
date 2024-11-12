<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'email',
        'is_admin',
        'password',
    ];

    protected static function booted()
    {
        // Log when a user is created
        static::created(function ($user) {
            Log::info('User created: ' . $user->name . ' (' . $user->email . ')');
        });

        // Log when a user is updated
        static::updated(function ($user) {
            Log::info('User updated: ' . $user->name . ' (' . $user->email . ')');
        });

        // Log when a user is deleted (soft delete)
        static::deleted(function ($user) {
            Log::info('User deleted: ' . $user->name . ' (' . $user->email . ')');
        });

        // Log when a user is permanently deleted
        static::forceDeleted(function ($user) {
            Log::info('User permanently deleted: ' . $user->name . ' (' . $user->email . ')');
        });
    }

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
    ];
}
