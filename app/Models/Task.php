<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'description',
        'title',
        'deadline',
    ];

    /**
     * Eloquent relationship with status
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Eloquent relationship with taskFollowers
     */
    public function taskFollowers()
    {
        return $this->hasMany(TaskFollower::class);
    }
}