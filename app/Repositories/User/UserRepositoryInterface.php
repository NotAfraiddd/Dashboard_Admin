<?php

namespace App\Repositories\User;

use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

interface UserRepositoryInterface extends RepositoryInterface
{
  /**
   * get user list
   * @param Request $request
   * @return void
   */
  public function getUserList(Request $request);

  /**
   * get detail user 
   * @param Request $request
   * @return void
   */
  public function getDetail($id, Request $request);
}
