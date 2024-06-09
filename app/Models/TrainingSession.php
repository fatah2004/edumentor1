<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_time',
        'end_time',
        'responsible_mentor_id',
    ];

    public function responsibleMentor()
    {
        return $this->belongsTo(User::class, 'responsible_mentor_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function postTrainingSessions()
    {
        return $this->hasMany(PostTrainingSession::class, 'original_session_id');
    }

    public function hasPostSession()
    {
        return $this->postTrainingSessions()->exists();
    }

    public function userAttendedPostSession($user)
{
    // Check if the post session exists and the user attended it
    return $this->postTrainingSessions()->whereHas('users', function ($query) use ($user) {
        $query->where('users.id', $user->id);
    })->exists();
}
protected $casts = [
    'start_time' => 'datetime',
    'end_time' => 'datetime',
];


}
