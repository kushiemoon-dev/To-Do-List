<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('tasks', [TaskController::class, 'list']);

Route::get('tasks/{id}', [TaskController::class, 'getSingleTask'])->where('id', '[0-9]+');

Route::post('tasks', [TaskController::class, 'createTask']);

Route::put('tasks/{id}', [TaskController::class, 'updateTask'])->where('id', '[0-9]+');

Route::delete('tasks/{id}', [TaskController::class, 'deleteTask'])->where('id', '[0-9]+');



