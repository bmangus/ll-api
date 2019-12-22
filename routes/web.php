<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return abort(403, 'Unauthorized');
});

Route::get('/formSubmissions/{formName}', 'FormSubmissionController@index');
Route::post('/formSubmission', 'FormSubmissionController@post');
Route::get('/formSubmission/{formName}/delete-forms', 'FormSubmissionController@deleteForms');
