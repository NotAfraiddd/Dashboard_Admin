<?php

namespace App\Repositories\Task;

use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Repositories\BaseRepository;
use App\Http\Controllers\Concerns\Paginatable;
use App\Http\Controllers\Concerns\Searchable;
use Illuminate\Support\Facades\DB;

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
      $query = $this->model->with('followers', 'statuses', 'assignee')->get();
      return $query;
    } catch (Exception $ex) {
      Log::error('Get status list: ' . $ex);
    }
  }

  /**
   * create task
   * @return mixed
   */
  public function createTask(Request $request)
  {
    DB::beginTransaction();
    try {
      $data = $request->all();
      $task = $this->model->create($data);
      DB::commit();
      return $task;
    } catch (Exception $ex) {
      DB::rollBack();
      Log::error('Create task: ' . $ex);
      return false;
    }
  }

  /**
   * get detail task 
   * @param Request $request
   * @return void
   */
  public function getDetail($id, Request $request)
  {
    try {
      $task = Task::with('assignee', 'followers', 'statuses')->findOrFail($id);

      return $task;
    } catch (Exception $ex) {
      Log::error('Error in getDetail method: ' . $ex->getMessage());
      return response()->json(['error' => 'Error server'], 500);
    }
  }
}