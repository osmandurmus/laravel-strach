<?php

use App\Services\Twitter;
use App\Repositories\UserRepository;

Route::get('/',function(Twitter $twitter){ // Twitter nesnesi otomatik olarak SocialServicesProvider tarafından çözülür.

    dd($twitter);

    return view("welcome");
});


Route::resource('projects','ProjectsController'); 

Route::post('/projects/{project}/tasks','ProjectTasksController@store');

Route::post('/completed-tasks/{task}', 'CompletedTasksController@store');

Route::delete('/completed-tasks/{task}', 'CompletedTasksController@destroy');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');










// DENEMELER

Route::get('/users',function(UserRepository $users){ // İnterface yi uygulayan service providerda yazan implementasyon classını çözümler.

    dd($users);

    return view("welcome");
});







// Route::get('/projects','ProjectsController@index');
// Route::get('/projects/create','ProjectsController@create');
// Route::get('/projects/{projects}','ProjectsController@show');
// Route::post('/projects','ProjectsController@store');
// Route::get('/projects/{projects}/edit','ProjectsController@edit');
// Route::patch('/projects/{project}','ProjectsController@update');
// Route::delete('/projects/{projects}','ProjectsController@destroy');
