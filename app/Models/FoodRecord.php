<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','food_name','calories','date','time','meal_type','image_path','notes', //memo
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
