<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relationship for sessions where the user is responsible
    public function responsibleSessions()
    {
        return $this->hasMany(TrainingSession::class, 'responsible_mentor_id');
    }

    // Relationship for sessions the user has attended
    public function attendedSessions()
    {
        return $this->belongsToMany(TrainingSession::class, 'training_session_user', 'user_id', 'training_session_id');
    }
}
