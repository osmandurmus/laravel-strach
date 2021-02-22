<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class ProjectCreated
{

    // EventServiceProvider'da register edildiği gibi SendProjectCreatedNotification listener' ı bu event'ı dinler.
    // Bu event class bir mantık içermez. Enjecte edilen Project Eloquent model nesnesi için bir container görevi görür.

    use Dispatchable, SerializesModels;

    public $project;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($project)
    {
        $this->project = $project;
    }

}
