
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
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Les URLs pour les routes définies dans api.php commenceront par /api (c'est le fonctionnement
// souhaité par Laravel)
// Pour cette route : l'URL sera donc /api/tasks
Route::get('/tasks', [TaskController::class, 'list']);

Route::get('/tasks/{id}', [TaskController::class, 'getSingleTask'])->where('id', '[0-9]+');

Route::post('/tasks', [TaskController::class, 'createTask']);

Route::patch('/tasks/{id}', [TaskController::class, 'updateTask'])->where('id', '[0-9]+');

Route::delete('/tasks/{id}', [TaskController::class, 'deleteTask'])->where('id', '[0-9]+');
