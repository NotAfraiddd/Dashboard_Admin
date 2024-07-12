<?php

namespace App\Repositories\Status;

use App\Models\Status;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Repositories\BaseRepository;
use App\Http\Controllers\Concerns\Paginatable;
use App\Http\Controllers\Concerns\Searchable;
use Illuminate\Support\Facades\DB;

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
      $keyword = $request->keyword;
      $query = Status::query();

      if (isset($keyword)) {
        $keyword = preg_replace('/\s+/', '', $keyword);
        $query->where(function ($q) use ($keyword) {
          $q->where("name", 'like', "%$keyword%")
            ->orWhere("color", 'like', "%$keyword%");
        });
      }

      return $query->get();
    } catch (Exception $ex) {
      Log::error('Get status list: ' . $ex);
    }
  }


  /**
   * create Status
   * @return mixed
   */
  public function createStatus(Request $request)
  {
    DB::beginTransaction();
    try {
      $data = $request->all();
      $status = $this->model->create($data);
      DB::commit();
      return $status;
    } catch (Exception $ex) {
      DB::rollBack();
      Log::error('Create status: ' . $ex);
      return false;
    }
  }

  /**
   * update Status
   * @return mixed
   */
  public function updateStatus(Request $request, Status $status)
  {
    DB::beginTransaction();
    try {
      $data = $request->all();
      $status->update($data);
      DB::commit();
      return $status;
    } catch (Exception $ex) {
      DB::rollBack();
      Log::error('Update Status: ' . $ex);
      return false;
    }
  }
}
