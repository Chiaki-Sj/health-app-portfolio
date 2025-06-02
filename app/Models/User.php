<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\FoodRecord;
use App\Models\ExerciseRecord;

/**
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\FoodRecord[] $foodRecords
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\ExerciseRecord[] $exerciseRecords
 */

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // 食事記録を取得
    public function foodRecords()
    {
        return $this->hasMany(FoodRecord::class);
    }

    // 運動記録を取得
    public function exerciseRecords()
    {
        return $this->hasMany(ExerciseRecord::class);
    }
}
