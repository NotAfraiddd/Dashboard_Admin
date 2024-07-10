<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskFollower extends Model
{
    use HasFactory;

    /**
     * Eloquent relationship with user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Eloquent relationship with task
     */
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}