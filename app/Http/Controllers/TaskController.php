<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\task;
use App\User;
use App\project;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function index($userid)
    {
        Log::info('Showing the user profile for user:'.$userid);
        $tasks = task::where('user_id', $userid )
            ->where('done','0')
            ->get();
        return $tasks;

    }
    public function completeindex($userid)
    {
        Log::info('Showing the user profile for user: '.$userid);
        $tasks = task::where('user_id', $userid)
            ->where('done','1')
            ->get();
        return $tasks;
    }
    public function allforproject($projectid)
    {
        Log::info('Showing the arg:allforproject:'.$projectid);
        $tasks = task::join('users', 'tasks.user_id','=','users.id')
        ->where('project_id',$projectid)
        ->where('done','0')
        ->get(["tasks.id as taskid","name",'title','time_limit','importance','title']);
        Log::info('Showing the tasks join userinfo for user: '.$tasks);
        return $tasks;
    }
    public function detail(task $task)  {
        Log::info('Showing the task before join: '.$task);
        Log::info('Showing the type of task: '.gettype($task));
        $getusername = User::select('name')->where('id',$task->user_id)->first();
        Log::info('Showing the getusername: '.$getusername);
        $task->user_name = $getusername->name;
        Log::info('showing the task join username :'.$task);
        return $task;
    }
    public function store(Request $request){
        Log::info('Showing the user profile for store: '.$request);
        return task::create($request->all());
    }
    public function update(Request $request,task $task){
        Log::info('Showing the user profile for storetask: '.$task);
        Log::info('Showing the user profile for store:request: '.$request);
        $task->update($request->all());
        return $task;
    }
    public function delete(task $task) {
        $task->delete();
        return $task;
    }
}
