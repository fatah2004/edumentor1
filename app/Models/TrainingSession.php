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
}
