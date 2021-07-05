<?php
use App\Http\controllers\TaskController;
use App\Http\controllers\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//TaskContoroller
Route::get('/tasks',[TaskController::class,'index']);
Route::post('/tasks',[TaskController::class,'store']);
Route::get('/tasks/{task}',[TaskController::class,'detail']);
Route::put('/tasks/{task}',[TaskController::class,'update']);
Route::delete('/tasks/{task}',[TaskController::class,'delete']);
//pojectContoroller
Route::get('/projects',[ProjectController::class,'index']);
Route::post('/projects',[ProjectController::class,'store']);
Route::get('/projects/{project}',[ProjectController::class,'detail']);
Route::put('/projects/{ project }',[ProjectController::class,'update']);
Route::delete('/projects/{project}',[ProjectController::class,'delete']);
//CompleteContoroller
Route::get('/completes',[TaskController::class,'completeindex']);