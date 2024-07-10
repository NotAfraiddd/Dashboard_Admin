<?php

namespace App\Repositories\Task;

use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Repositories\BaseRepository;
use App\Http\Controllers\Concerns\Paginatable;
use App\Http\Controllers\Concerns\Searchable;

class TaskRepository extends BaseRepository implements TaskRepositoryInterface
{
  use Paginatable, Searchable;

  /**
   * get model
   * @return string
   */
  public function getModel()
  {
    return Task::class;
  }

  /**
   * get status list
   * @param Request $request
   * @return void
   */
  public function getTaskList(Request $request)
  {
    try {
      $query = $this->model->with('status', 'task_followers', 'task_followers.user')->get();
      return $query;
    } catch (Exception $ex) {
      Log::error('Get status list: ' . $ex);
    }
  }
}
