<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Project;

class ProjectTasksController extends Controller
{

    public function store(Project $project){  //Model binding
        
        
        $attributes = request()->validate(['description' => 'required']);

        $project->addTask($attributes);

        return back();

    }

    public function update(Task $task){
        
        $task->complete(request()->has('completed'));
        
        // $task->update([
        //     'completed' => request()->has('completed')
        // ]);

        return back();
    }
}
