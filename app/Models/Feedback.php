<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'post_training_session_id', 'comment', 'rating'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function postTrainingSession()
    {
        return $this->belongsTo(PostTrainingSession::class);
    }
}
