<?php

class JobtitlesController extends \BaseController {

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
		// ref : app/views/jobtitles/index.blade.php
		$this->layout->content = View::make('jobtitles.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		// generate view for this actions
        // ref : app/views/jobtitles/create.blade.php
        $this->layout->content = View::make('jobtitles.create',array(
            'previousUrl' => $this->getPreviousUrl(route('jobtitles.index'))
        ));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// Get all $_POST data, then create new jobtitle object
        $jobtitle = new Jobtitle(Input::all());

        // Validate jobtitle with rule set in model
        // ref : app/models/jobtitle.php
        if (!$jobtitle->validate()) {
            // if not validate, return flaseh error message
            // ref : app/controllers/BaseController.php
            return $this->formError($jobtitle);
        }

        // save jobtitle to database
        $jobtitle->save();

        // Redirect to previous page
        $targetUrl = Session::get('prevUrl'); // check BaseController@getPreviousUrl
        $redirect = Redirect::back(301)->setTargetUrl($targetUrl)
            ->with('success-message', "Job Title <b>$jobtitle->title</b> berhasil dibuat!");

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
	 * @param  Jobtitle  $jobtitles
	 * @return Response
	 */
	public function edit(Jobtitle $jobtitles)
	{
		// generate view for this actions
        // ref : app/views/jobtitles/edit.blade.php
        $this->layout->content = View::make('jobtitles.edit', array(
            'jobtitle' => $jobtitles,
            'previousUrl'=>$this->getPreviousUrl(route('jobtitles.index'))
        ));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Jobtitle    $jobtitles
	 * @return Response
	 */
	public function update(Jobtitle $jobtitles)
	{
		// update all field
        $jobtitles->fill(Input::all());

        // Validate jobprefix with rule set in model
        // ref : app/models/jobprefix.php
        if (!$jobtitles->validate()) {
            // if not validate, return flaseh error message
            // ref : app/controllers/BaseController.php
            return $this->formError($jobtitles);
        }

        // save jobprefix to database
        $jobtitles->save();

        // Redirect to previous page
        $targetUrl = Session::get('prevUrl'); // check BaseController@getPreviousUrl
        $redirect = Redirect::back(301)->setTargetUrl($targetUrl)
            ->with('success-message', "Job Title <b>$jobtitles->title</b> berhasil diperbaharui!");

        return $redirect;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  Jobtitle  $jobtitles
	 * @return Response
	 */
	public function destroy(Jobtitle $jobtitles)
	{
        // Get old title
        $title = $jobtitles->title;

		// delete jobtitle from database
        $jobtitles->delete();

        // redirect to index page
        return Redirect::to('jobtitles')
            ->with('success-message', 'Job Title <b>'.$title.'</b> berhasil dihapus.');
	}

	/**
	 * Get specified data for datatable
	 * ref : https://github.com/Chumper/Datatable
	 * @return json
	 */
	public function getDatatable()
	{
		return Datatable::collection(Jobtitle::all())
            ->showColumns('id', 'code', 'title')
            ->addColumn('jobprefix', function ($model) {
            	return $model->jobprefix->title;
            })
            ->addColumn('functionalscope', function ($model) {
            	return $model->functionalscope->title;
            })
            ->addColumn('status', function ($model) {
            	return Form::checkbox('status', 'status', $model->status, array('disabled'));
            })
            ->searchColumns('title', 'jobprefix', 'functionalscope')
            ->orderColumns('title', 'jobprefix', 'functionalscope')
            ->addColumn('action', function ($model) {
                $html = '<a href='.route('jobtitles.edit', ['jobtitles'=>$model->id]).' class="m-l-sm"><i class="fa fa-edit fa-hover" data-toggle="tooltip" data-placement="top" title="Ubah"></i></a>';
                $html .= Form::open(array('url' => "jobtitles/$model->id", 'role' => 'form', 'method'=>'delete','class'=>'form-inline','style="display:inline;"'));
                $html .=   Form::submit('Delete', array('class' => 'hidden'));
                $html .= '<a href="#" data-confirm="Anda yakin akan menghapus job prefix '.$model->title.' ?" class="m-l-sm js-delete-confirm"><i class="fa fa-times fa-hover" data-toggle="tooltip" data-placement="top" title="Hapus"></i></a>';
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
        $validator = Validator::make(Input::all(), Jobtitle::$rules);
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