<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProjectCreated;

class Project extends Model
{
    protected $guarded=[];

    protected static function boot(){ 
        
        parent::boot();

                                                        // hooking created project, this is TRADITIONAL EVENT
        static::created(function ($project) {           // after a project created, works this method ----------------  *updated,*deleted vs
            Mail::to($project->owner->email)->send(     // project owner'a mail gönderecek
                new ProjectCreated($project)
            );
        });
    }

    public function owner(){
        return $this->belongsTo(User::class);
    }

    public function tasks(){ 
        return $this->hasMany(Task::class);
    }

    public function addTask($task){ // Yes a project can add task
        
        $this->tasks()->create($task);
        
        // return Task::create([
        //     'project_id' => $this->id,
        //     'description' => $description
        // ]);
    }
}
