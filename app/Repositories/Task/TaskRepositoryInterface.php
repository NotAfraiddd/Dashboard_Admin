<?php

namespace App\Repositories\Task;

use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

interface TaskRepositoryInterface extends RepositoryInterface
{
  /**
   * get status list
   * @param Request $request
   * @return void
   */
  public function getTaskList(Request $request);

  /**
   * create task
   * @return mixed
   */
  public function createTask(Request $request);


  /**
   * get detail task 
   * @param Request $request
   * @return void
   */
  public function getDetail($id, Request $request);
}