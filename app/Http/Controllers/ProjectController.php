<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\project;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    public function index()
    {
        return project::all();
    }

    public function detail(project $project)
    {
        Log::info('Showing the detail for project: $project');
        return $project;
    }
    public function store(Request $request)
    {
        return project::create($request->all());
    }
    public function update(Request $request ,project $project) {
        $project->update($request->all());
        return $project;
    }
    public function delete(project $project)
    {
        $project->delete();

        return $project;
    }
}
