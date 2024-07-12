<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Status;
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

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            return response()->json($this->statusRepo->createStatus($request));
        } catch (Exception $ex) {
            Log::error('Create Status: ' . $ex);
            return response()->json(['error' => 'Error server'], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Status $status)
    {
        try {
            $result = $this->statusRepo->updateStatus($request, $status);
            if (!$result) {
                return response()->json(
                    ['error' => 'Error server'],
                    400
                );
            }
            return response()->json($result);
        } catch (Exception $ex) {
            Log::error('update user Err: ' . $ex);
            return response()->json(['error' => 'Error server'], 500);
        }
    }

    /**
     * Detail Status
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        try {
            $status = Status::findOrFail($id);
            return response()->json($status);
        } catch (Exception $ex) {
            Log::error('Detail Status: ' . $ex);
            return response()->json(['error' => 'サーバーが不正です。'], 500);
        }
    }
}