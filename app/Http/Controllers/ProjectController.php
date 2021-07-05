<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\project;

class ProjectController extends Controller
{
    public function index()
    {
        return project::all();
    }

    public function detail(project $project)
    {
        return $project;
    }
    public function store(Request $request)
    {
        return project::create($request->all());
    }
    public function update(Request $request ,project $project) {
        $project->update($request->all());
        return $task;
    }
    public function delete(project $project)
    {
        $project->delete();

        return $project;
    }
}
