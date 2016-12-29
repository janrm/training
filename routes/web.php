<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/training/trainers', 'TrainingController@trainers');
Route::get('/trainer/{trainer_id}', 'TrainerController@index');
Route::get('/trainer/status/confirmed','TrainerController@update_status');
Route::get('/trainer/status/cancelled','TrainerController@update_status');
Route::get('/trainer/status/changed','TrainerController@update_status');
Route::get('/trainer/status/reset','TrainerController@update_status');
Route::post('/trainer/status/confirmed','TrainerController@update_status');
Route::post('/trainer/status/cancelled','TrainerController@update_status');
Route::post('/trainer/status/changed','TrainerController@update_status');
Route::post('/trainer/status/reset','TrainerController@update_status');
Route::resource('training', 'TrainingController');
