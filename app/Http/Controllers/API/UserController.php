<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $data = $this->userRepo->getUserList($request);
            return response()->json($data);
        } catch (Exception $ex) {
            Log::error('Get List user: ' . $ex);
            return response()->json(['error' => 'Error server'], 500);
        }
    }

    /**
     * Detail User
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        try {
            $status = User::findOrFail($id);
            return response()->json($status);
        } catch (Exception $ex) {
            Log::error('Detail User: ' . $ex);
            return response()->json(['error' => 'サーバーが不正です。'], 500);
        }
    }
}