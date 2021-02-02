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

        $method = request()->has('completed') ? 'complete' : 'incomplete' ;
        
        $task->$method();

        // Other Approach
        // if(request()->has('completed')){
        //     $task->complete();
        // }else{
        //     $task->incomplete();
        // }
        
        // Other Approach
        //request()->has('completed') ? $task->complete() : $task->incomplete();

        return back();
    }
}
