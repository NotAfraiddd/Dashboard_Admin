<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTaskRequest;
use App\Repositories\Task\TaskRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    protected $taskRepo;

    public function __construct(TaskRepositoryInterface $taskRepo)
    {
        $this->taskRepo = $taskRepo;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $data = $this->taskRepo->getTaskList($request);
            return response()->json($data);
        } catch (Exception $ex) {
            Log::error('Get List tasks: ' . $ex);
            return response()->json(['error' => 'Error server'], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     * @param CreateTaskRequest $request
     * @return \Illuminate\Http\Response
     */
    public function create(CreateTaskRequest $request)
    {
        try {
            return response()->json($this->taskRepo->createTask($request));
        } catch (Exception $ex) {
            Log::error('Create task: ' . $ex);
            return response()->json(['error' => 'Error server'], 500);
        }
    }
}
