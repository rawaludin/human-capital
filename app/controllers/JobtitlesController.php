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
		// ref : app/views/jobprefixes/index.blade.php
		$this->layout->content = View::make('jobtitles.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
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
                $html = '<a href='.route('jobprefixes.edit', ['jobprefixes'=>$model->id]).' class="m-l-sm"><i class="fa fa-edit fa-hover" data-toggle="tooltip" data-placement="top" title="Ubah"></i></a>';
                $html .= Form::open(array('url' => "jobprefixes/$model->id", 'role' => 'form', 'method'=>'delete','class'=>'form-inline','style="display:inline;"'));
                $html .=   Form::submit('Delete', array('class' => 'hidden'));
                $html .= '<a href="#" data-confirm="Anda yakin akan menghapus job prefix '.$model->title.' ?" class="m-l-sm js-delete-confirm"><i class="fa fa-times fa-hover" data-toggle="tooltip" data-placement="top" title="Hapus"></i></a>';
                $html .= Form::close();

                return $html;
            })
            ->make();
	}

}