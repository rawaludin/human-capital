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
Route::resource('functionalscopes', 'FunctionalscopesController');
Route::resource('jobtitles', 'JobtitlesController');

// Model binding for resources controller
Route::model('jobprefixes', 'Jobprefix');
Route::model('functionalscopes', 'Functionalscope');
Route::model('jobtitles', 'Jobtitle');

// API for datatable
Route::get('api/jobprefixes',
    array('as'=>'api.jobprefixes', 'uses'=>'JobprefixesController@getDatatable'));
Route::get('api/functionalscopes',
    array('as'=>'api.functionalscopes', 'uses'=>'FunctionalScopesController@getDatatable'));
Route::get('api/jobtitles',
    array('as'=>'api.jobtitles', 'uses'=>'JobtitlesController@getDatatable'));

// API for parsley validate
Route::get('api/jobprefixes/validatecode',
    array('as'=>'api.jobprefixesvalidatecode', 'uses'=>'JobprefixesController@validateField'));
Route::get('api/functionalscopes/validate',
    array('as'=>'api.functionalscopes.validate', 'uses'=>'FunctionalscopesController@validateField'));
