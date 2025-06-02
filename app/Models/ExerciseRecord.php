<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExerciseRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'exercise_name',
        'calories_burned',
        'duration',
        'date',
        'time',
        'notes',
        'youtube_url',
    ];

    protected $casts = [
        'date' => 'date',
        'time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
