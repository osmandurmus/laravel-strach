<?php

namespace App;

use App\Events\ProjectCreated;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded=[];

    protected $dispatchesEvents = [
        'created' => ProjectCreated::class    // Another approach for custom event listener, Bir proje create edildiğinde otomatik ProjectCreated event nesnesi oluşur.
    ];

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


    // For Eloquent event hook
    // protected static function boot(){
        
    //     parent::boot();
    //                                                     // hooking created project, this is TRADITIONAL EVENT
    //     static::created(function ($project) {           // after a project created, works this method ----------------  *updated,*deleted vs
    //         Mail::to($project->owner->email)->send(     // project owner'a mail gönderecek
    //             new ProjectCreated($project)            // This ProjectCreated points mailable class
    //         );
    //     });
    // }
}
