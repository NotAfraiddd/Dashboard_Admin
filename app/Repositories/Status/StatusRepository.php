<?php

namespace App\Repositories\Status;

use App\Models\Status;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Repositories\BaseRepository;
use App\Http\Controllers\Concerns\Paginatable;
use App\Http\Controllers\Concerns\Searchable;

class StatusRepository extends BaseRepository implements StatusRepositoryInterface
{
  use Paginatable, Searchable;

  /**
   * get model
   * @return string
   */
  public function getModel()
  {
    return Status::class;
  }

  /**
   * get status list
   * @param Request $request
   * @return void
   */
  public function getStatusList(Request $request)
  {
    try {
      return $this->model->get();
    } catch (Exception $ex) {
      Log::error('Get status list: ' . $ex);
    }
  }
}
