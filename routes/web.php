<?php

Route::get('/',function(){
    return "welcome";
});

Route::resource('projects','ProjectsController');

Route::post('/projects/{project}/tasks','ProjectTasksController@store');

Route::post('/completed-tasks/{task}', 'CompletedTasksController@store');

Route::delete('/completed-tasks/{task}', 'CompletedTasksController@destroy');

















// Route::get('/projects','ProjectsController@index');
// Route::get('/projects/create','ProjectsController@create');
// Route::get('/projects/{projects}','ProjectsController@show');
// Route::post('/projects','ProjectsController@store');
// Route::get('/projects/{projects}/edit','ProjectsController@edit');
// Route::patch('/projects/{project}','ProjectsController@update');
// Route::delete('/projects/{projects}','ProjectsController@destroy');











