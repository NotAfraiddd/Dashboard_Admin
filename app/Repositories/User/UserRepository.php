<?php

namespace App\Repositories\User;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Repositories\BaseRepository;
use App\Http\Controllers\Concerns\Paginatable;
use App\Http\Controllers\Concerns\Searchable;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
  use Paginatable, Searchable;

  /**
   * get model
   * @return string
   */
  public function getModel()
  {
    return User::class;
  }

  /**
   * get user list
   * @param Request $request
   * @return void
   */
  public function getUserList(Request $request)
  {
    try {
      $query = $this->model->with('tasks.task_followers.user', 'tasks.statuses')->get();
      return $query;
    } catch (Exception $ex) {
      Log::error('Get user list: ' . $ex);
    }
  }

  /**
   * get detail user 
   * @param Request $request
   * @return void
   */
  public function getDetail($id, Request $request)
  {
    try {
      $taskId = $request->task_id;

      $user = User::with(['tasks' => function ($query) use ($taskId) {
        $query->where('id', $taskId)
          ->with('task_followers.user', 'statuses');
      }])->findOrFail($id);

      return $user;
    } catch (Exception $ex) {
      Log::error('Error in getDetail method: ' . $ex->getMessage());
      return response()->json(['error' => 'Error server'], 500);
    }
  }
}
