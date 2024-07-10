<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\Status\StatusRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StatusController extends Controller
{
    protected $statusRepo;

    public function __construct(StatusRepositoryInterface $statusRepo)
    {
        $this->statusRepo = $statusRepo;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $data = $this->statusRepo->getStatusList($request);
            return response()->json($data);
        } catch (Exception $ex) {
            Log::error('Get List statuses: ' . $ex);
            return response()->json(['error' => 'Error server'], 500);
        }
    }
}
