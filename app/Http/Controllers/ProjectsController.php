<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Services\Twitter;
use App\Mail\ProjectCreated;

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

        //abort_if( $project->owner_id !== auth()->id(), 403); // authorization --> kullanıcı başkasının projesini görüntüleyemeyecek.  abort_if helper func

        //abort_unless(auth()->user()->owns($project), 403); // authorization another approach

        // if(\Gate::denies('update', $project)){ // authorization another approach
        //     abort(403);
        // }

        // abort_if(\Gate::denies('update', $project), 403);  // authorization another approach

        // abort_unless(\Gate::allows('update', $project), 403); // authorization another approach

        // auth()->user()->can('update', $project); // authorization another approach, can Middleware\Authorize::class' ı referans eder.

        $this->authorize('update', $project); // authorization ve sağlanamazsa abort 403 üretir, authorize method policy class'a referans eder. Another approach
   
        return view('projects.show',compact('project'));
    }

    public function store(){
        //backend validation control
        $attributes = request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:3']
        ]);

        $attributes['owner_id'] = auth()->id();  // diziye yeni key value eklendi -- auth()->id() giriş yapan user'ın id'sini verir

        $project = Project::create($attributes);

        \Mail::to('jane@example.com')->send(
            new ProjectCreated($project)
        );

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