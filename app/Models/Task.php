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
        return $this->belongsToMany(Status::class, 'task_statuses');
    }

    /**
     * Eloquent relationship with followers (users following this task)
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'task_followers');
    }

    /**
     * Eloquent relationship with assignee (user assigned to this task)
     */
    public function assignee()
    {
        return $this->belongsTo(User::class, 'assign_id');
    }
}
