<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Services\Twitter;

class ProjectsController extends Controller
{

    public function __construct(){
        
        $this->middleware('auth'); // Sadece kimlik doğrulaması yapanlar erişebilecek. Bu controllerdaki her bir action'a uygulanır.  --protected
                                    // middleware('auth')->only(['store','update'])  or middleware('auth')->except(['show]) ihtiyaca göre kullanılabilir.
                                    // middleware constructor haricinde route'lara da direk uygulanabilir.
    }

    public function index(){

        $projects = Project::where('owner_id',auth()->id())->get(); // select * from projects where owner_id = 4 -- kendisine ait projeleri getirir

        return view('projects.index',compact('projects'));
    }

    public function create(){
        return view('projects.create');
    }

    public function show(Project $project){
        
        return view('projects.show',compact('project'));
    }

    public function store(){
        //backend validation control
        $attributes = request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:3']
        ]);

        $attributes['owner_id'] = auth()->id();  // diziye yeni key value eklendi -- auth()->id() giriş yapan user'ın id'sini verir

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