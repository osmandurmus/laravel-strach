<?php



// app()->singleton('App\Example',function(){ // app()->singleton gives same instance, app()->bind gives different uniq instance
//     dd("called");
//     return new \App\Example;
// });

app()->singleton('App\Services\Twitter', function(){
    return new App\Services\Twitter('asdf twitter key');
});

Route::get('/',function(){

    dd(app('App\Example')); // Class yolunu key olarak verirsek auto-resolution ile app()->singleton veya app()->bind ile bağlama yapmaya gerek kalmayabilir. Key varsa ilk olarak keye bakar yoksa class ismine göre auot-resolution yapar

    return view("welcome");
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











