<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReplyController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});
/* Route::get('/user', function (Request $request) {
return $request->user();
})->middleware('auth:admin'); */


Route::post('/login',[App\Http\Controllers\LoginController::class,'login']);
Route::post('/logout',[App\Http\Controllers\LoginController::class,'logout']);
//TaskController
Route::get('/tasks/list/{userid}',[TaskController::class,'index']);
Route::get('/tasks/allforproject/{projectid}',[TaskController::class,'allforproject']);
Route::post('/tasks/store',[TaskController::class,'store']);
Route::get('/tasks/{task}',[TaskController::class,'detail']);
Route::put('/tasks/{task}',[TaskController::class,'update']);
Route::delete('/tasks/{task}',[TaskController::class,'delete']);
//pojectController
Route::get('/projects',[ProjectController::class,'index']);
Route::post('/projects',[ProjectController::class,'store']);
Route::get('/projects/{project}',[ProjectController::class,'detail']);
Route::put('/projects/{project}',[ProjectController::class,'update']);
Route::delete('/projects/{project}',[ProjectController::class,'delete']);
//CompleteController
Route::get('/completes/{userid}',[TaskController::class,'completeindex']);

//commentAPI
Route::post('/comments/store',[CommentController::class,'store']);
Route::delete('/comments/delete/{comment}', [CommentController::class,'delete']);
Route::get('/comments/{taskid}',[CommentController::class,'index']);
Route::put('/comments/{comment}',[CommentController::class,'update']);
Route::delete('/comments/delete/{comment}', [CommentController::class,'delete']);

//replyAPI
Route::post('/reply/store',[ReplyController::class,'store']);
Route::get('/reply/sumreply/{commentid}',[ReplyController::class,'getsumofcomment']);
Route::get('/reply/{commentid}',[ReplyController::class,'index']);
Route::put('/reply/{reply}',[ReplyController::class,'update']);
Route::delete('/reply/{reply}', [ReplyController::class,'delete']);

