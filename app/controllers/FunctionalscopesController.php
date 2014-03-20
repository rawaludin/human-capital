<?php

class FunctionalscopesController extends \BaseController {

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
		// ref : app/views/functionalscopes/index.blade.php
		$this->layout->content = View::make('functionalscopes.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		// generate view for this actions
		// ref : app/views/functionalscopes/create.blade.php
		$this->layout->content = View::make('functionalscopes.create',array(
			'previousUrl' => $this->getPreviousUrl(route('functionalscopes.index'))
		));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// Get all $_POST data, then create new functionalscope object
		$functionalscope = new Functionalscope(Input::all());

		// Validate functionalscope with rule set in model
		// ref : app/models/functionalscope.php
		if (!$functionalscope->validate()) {
			// if not validate, return flaseh error message
			// ref : app/controllers/BaseController.php
            return $this->formError($functionalscope);
        }

        // save functionalscope to database
        $functionalscope->save();

        // Redirect to previous page
        $targetUrl = Session::get('prevUrl'); // check BaseController@getPreviousUrl
        $redirect = Redirect::back(301)->setTargetUrl($targetUrl)
            ->with('success-message', "Functional Scope <b>$functionalscope->title</b> berhasil dibuat!");

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
	 *
	 * @param  Functionalscope  $functionalscopes
	 * @return Response
	 */
	public function edit(Functionalscope $functionalscopes)
	{
		// generate view for this actions
		// ref : app/views/functionalscopes/edit.blade.php
		$this->layout->content = View::make('functionalscopes.edit', array(
		    'functionalscope' => $functionalscopes,
            'previousUrl'=>$this->getPreviousUrl(route('functionalscopes.index'))
        ));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Functionalscope  $functionalscopes
	 * @return Response
	 */
	public function update(Functionalscope $functionalscopes)
	{
		// update all field
		$functionalscopes->fill(Input::all());

		// Validate functionalscope with rule set in model
		// ref : app/models/functionalscope.php
		if (!$functionalscopes->validate()) {
			// if not validate, return flaseh error message
			// ref : app/controllers/BaseController.php
            return $this->formError($functionalscopes);
        }

        // save functionalscope to database
        $functionalscopes->save();

        // Redirect to previous page
        $targetUrl = Session::get('prevUrl'); // check BaseController@getPreviousUrl
        $redirect = Redirect::back(301)->setTargetUrl($targetUrl)
            ->with('success-message', "Functional Scope <b>$functionalscopes->title</b> berhasil diperbaharui!");

        return $redirect;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Functionalscope $functionalscopes)
	{
		// Get old title for flash message
		$title = $functionalscopes->title;

		// delete resource from database
		$functionalscopes->delete();

		// redirect
		return Redirect::to('functionalscopes')
			->with('success-message', 'Functional Scope <b>'.$title.'</b> berhasil dihapus.');
	}

	/**
	 * Get specified data for datatable
	 * ref : https://github.com/Chumper/Datatable
	 * @return json
	 */
	public function getDatatable()
	{
		return Datatable::collection(Functionalscope::all())
            ->showColumns('id', 'code', 'title')
            ->searchColumns('code', 'title')
            ->orderColumns('code','title')
            ->addColumn('action', function ($model) {
                $html = '<a href='.route('functionalscopes.edit', ['functionalscopes'=>$model->id]).' class="m-l-sm"><i class="fa fa-edit fa-hover" data-toggle="tooltip" data-placement="top" title="Ubah"></i></a>';
                $html .= Form::open(array('url' => "functionalscopes/$model->id", 'role' => 'form', 'method'=>'delete','class'=>'form-inline','style="display:inline;"'));
                $html .=   Form::submit('Delete', array('class' => 'hidden'));
                $html .= '<a href="#" data-confirm="Anda yakin akan menghapus functional scope '.$model->title.' ?" class="m-l-sm js-delete-confirm"><i class="fa fa-times fa-hover" data-toggle="tooltip" data-placement="top" title="Hapus"></i></a>';
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
		$validator = Validator::make(Input::all(), Functionalscope::$rules);
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