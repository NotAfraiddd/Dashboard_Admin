<?php

namespace App\Repositories\Status;

use App\Models\Status;
use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

interface StatusRepositoryInterface extends RepositoryInterface
{
  /**
   * get status list
   * @param Request $request
   * @return void
   */
  public function getStatusList(Request $request);


  /**
   * create Status
   * @return mixed
   */
  public function createStatus(Request $request);


  /**
   * update Status
   * @return mixed
   */
  public function updateStatus(Request $request, Status $status);
}
