<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = task::where('user_id', '1' )
            ->where('done','0')
            ->get();
        return $tasks;

    }
    public function completeindex()
    {
        $tasks = task::where('user_id', '1' )
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
