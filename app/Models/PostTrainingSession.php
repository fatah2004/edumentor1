<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
 
    public function feedback()
{
    return $this->hasMany(Feedback::class);
}


    
public function getUserFeedback()
{
    if ($this->feedback()->exists()) { // Ensure to call the feedback method
        return $this->feedback()->where('user_id', Auth::id())->first();
    }
    return null;
}

}
