<?php

class JobprefixesController extends \BaseController {

	/**
     * The layout that should be used for responses.
     * ref : app/views/layouts/dashboard.blade.php
     */
    protected $layout = 'layouts.dashboard';

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// generate view for this actions
		// ref : app/views/jobprefixes/index.blade.php
		$this->layout->content = View::make('jobprefixes.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		// generate view for this actions
		// ref : app/views/jobprefixes/create.blade.php
		$this->layout->content = View::make('jobprefixes.create',array(
			'previousUrl' => $this->getPreviousUrl(route('jobprefixes.index'))
		));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// Get all $_POST data, then create new jobprefix object
		$jobprefix = new Jobprefix(Input::all());

		// Validate jobprefix with rule set in model
		// ref : app/models/jobprefix.php
		if (!$jobprefix->validate()) {
			// if not validate, return flaseh error message
			// ref : app/controllers/BaseController.php
            return $this->formError($jobprefix);
        }

        // save jobprefix to database
        $jobprefix->save();

        // Redirect to previous page
        $targetUrl = Session::get('prevUrl'); // check BaseController@getPreviousUrl
        $redirect = Redirect::back(301)->setTargetUrl($targetUrl)
            ->with('success-message', "Job Prefix <b>$jobprefix->title</b> berhasil dibuat!");

        return $redirect;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * This form done by model binding.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Jobprefix $jobprefixes)
	{
		// generate view for this actions
		// ref : app/views/jobprefixes/edit.blade.php
		$this->layout->content = View::make('jobprefixes.edit', array(
		    'jobprefix' => $jobprefixes,
            'previousUrl'=>$this->getPreviousUrl(route('jobprefixes.index'))
        ));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Jobprefix $jobprefixes)
	{
		// update all field
		$jobprefixes->fill(Input::all());

		// Validate jobprefix with rule set in model
		// ref : app/models/jobprefix.php
		if (!$jobprefixes->validate()) {
			// if not validate, return flaseh error message
			// ref : app/controllers/BaseController.php
            return $this->formError($jobprefixes);
        }

        // save jobprefix to database
        $jobprefixes->save();

        // Redirect to previous page
        $targetUrl = Session::get('prevUrl'); // check BaseController@getPreviousUrl
        $redirect = Redirect::back(301)->setTargetUrl($targetUrl)
            ->with('success-message', "Job Prefix <b>$jobprefixes->title</b> berhasil diperbaharui!");

        return $redirect;

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Jobprefix $jobprefixes)
	{
		// Get old title
		$title = $jobprefixes->title;

		// delete jobprefixes
		$jobprefixes->delete();

		// redirect to index page
		return Redirect::to('jobprefixes')
			->with('success-message', 'Job Prefix <b>'.$title.'</b> berhasil dihapus.');
	}

	/**
	 * Get specified data for datatable
	 * ref : https://github.com/Chumper/Datatable
	 * @return json
	 */
	public function getDatatable()
	{
		return Datatable::collection(Jobprefix::all())
            ->showColumns('id', 'code', 'title')
            ->searchColumns('code', 'title')
            ->orderColumns('code','title')
            ->addColumn('action', function ($model) {
                $html = '<a href='.route('jobprefixes.edit', ['jobprefixes'=>$model->id]).' class="m-l-sm"><i class="fa fa-edit fa-hover" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>';
                $html .= Form::open(array('url' => "jobprefixes/$model->id", 'role' => 'form', 'method'=>'delete','class'=>'form-inline','style="display:inline;"'));
                $html .=   Form::submit('Delete', array('class' => 'hidden'));
                $html .= '<a href="#" data-confirm="Anda yakin akan menghapus job prefix '.$model->title.' ?" class="m-l-sm js-delete-confirm"><i class="fa fa-times fa-hover" data-toggle="tooltip" data-placement="top" title="Delete"></i></a>';
                $html .= Form::close();

                return $html;
            })
            ->make();
	}

	/**
	 * API for model field frontend validation
	 * @return json
	 */
	public function validateField() {
		// get field to validate
		$field = key(Input::query());

		// create validator
		$validator = Validator::make(Input::all(), Jobprefix::$rules);
		$messages = $validator->messages();
		if ($messages->has($field))
		{
			// return error message
		    return json_encode(array("error"=>$messages->first($field)));
		} else {
			// return true
			return json_encode(array("success"=>''));
		}
	}

}