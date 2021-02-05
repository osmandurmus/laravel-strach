<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Services\Twitter;

class ProjectsController extends Controller
{
    public function index(){

        $projects = Project::all();

        return view('projects.index',compact('projects'));
    }

    public function create(){
        return view('projects.create');
    }

    public function show(Project $project, Twitter $twitter){

        dd($twitter);
        
        return view('projects.show',compact('project'));
    }

    public function store(){
        //backend validation control
        $attributes = request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:3']
        ]);

        Project::create($attributes);

        return redirect('/projects');


        // Mass Assignment, if you use this way you must write filliable or guard property in Model clas for MassAssignment Exception.
        // Project::create([
        //     'title' => request('title'),
        //     'description' => request('description')
        // ]);
        
        //or

        // $project = new Project();
        // $project->title = request('title');
        // $project->description = request('description');
        // $project->save();  
    }

    public function edit(Project $project){ //Model binding
        
        return view('projects.edit',compact('project'));
    }
 
    public function update(Project $project){ //Model binding
        
        $project->title = request('title');
        $project->description = request('description');

        $project->save();

        return redirect('/projects');
    }

    public function destroy(Project $project){ //Model binding

        $project->delete();

        return redirect('/projects');
        
    }  
}