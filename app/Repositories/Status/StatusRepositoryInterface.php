<?php

namespace App\Repositories\Status;

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
}
