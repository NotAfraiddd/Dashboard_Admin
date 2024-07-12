<?php

use App\Http\Controllers\API\StatusController;
use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// user
Route::get('/users', [UserController::class, 'index']);
Route::post('/user/create', [UserController::class, 'create']);
Route::get('/user/{user}/detail', [UserController::class, 'detail']);
Route::post('/user/{user}/update', [UserController::class, 'update']);


// status
Route::get('/statuses', [StatusController::class, 'index']);
Route::post('/status/create', [StatusController::class, 'create']);
Route::get('/status/{status}/detail', [StatusController::class, 'detail']);
Route::post('/status/{status}/update', [StatusController::class, 'update']);

// task
Route::get('/tasks', [TaskController::class, 'index']);
Route::post('/task/create', [TaskController::class, 'create']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
