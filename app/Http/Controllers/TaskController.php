<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\task;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function index(Request $request,$userid)
    {
        Log::info('Showing the user profile for user: '.$userid);
        $tasks = task::where('user_id', $userid )
            ->where('done','0')
            ->get();
        return $tasks;

    }
    public function completeindex(Request $request,$userid)
    {
        Log::info('Showing the user profile for user: '.$userid);
        $tasks = task::where('user_id', $userid)
            ->where('done','1')
            ->get();
        return $tasks;
    }
    public function detail(task $task)  {
        return $task;
    }
    public function store(Request $request){

        return task::create($request->all());
    }
    public function update(Request $request,task $task){
        $task->update($request->all());
        return $task;
    }
    public function delete(task $task) {
        $task->delete();
        return $task;
    }
}
