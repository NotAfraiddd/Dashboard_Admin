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
        'status_id',
        'title',
        'description',
        'deadline',
    ];

    /**
     * Eloquent relationship with statuses
     */
    public function statuses()
    {
        return $this->hasMany(Status::class);
    }

    /**
     * Eloquent relationship with task_followers
     */
    public function task_followers()
    {
        return $this->hasMany(TaskFollower::class);
    }


    /**
     * Eloquent relationship with assign
     */
    public function assign()
    {
        return $this->belongsTo(User::class, 'assign_id');
    }
}
