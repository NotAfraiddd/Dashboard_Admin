<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
  use HasFactory;

  protected $fillable = [
    'task_id', 'status_id',
  ];

  /**
   * Eloquent relationship with task
   */
  public function task()
  {
    return $this->belongsTo(Task::class);
  }

  /**
   * Eloquent relationship with status
   */
  public function status()
  {
    return $this->belongsTo(Status::class);
  }
}
