<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});
// Resource controller
Route::resource('jobprefixes', 'JobprefixesController');

// Model binding for resources controller
Route::model('jobprefixes', 'Jobprefix');

// API for datatable
Route::get('api/jobprefixes',
        array('as'=>'api.jobprefixes', 'uses'=>'JobprefixesController@getDatatable'));
