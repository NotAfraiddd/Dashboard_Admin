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
      return $this->model->get();
    } catch (Exception $ex) {
      Log::error('Get user list: ' . $ex);
    }
  }
}
