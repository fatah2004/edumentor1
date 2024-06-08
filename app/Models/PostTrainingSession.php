<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTrainingSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_time',
        'end_time',
        'responsible_mentor_id',
        'original_session_id',
    ];

    public function originalSession()
    {
        return $this->belongsTo(TrainingSession::class, 'original_session_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'post_training_session_user', 'post_training_session_id', 'user_id');
    }
    
}
