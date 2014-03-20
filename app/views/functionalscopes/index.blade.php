@section('pagecss')
    <link rel="stylesheet" href="{{ asset('js/datatables/datatables.css') }}" type="text/css" cache="false"/>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
@stop

@section('breadcrumb')
    <li><a href="#">Functional Scope</a></li>
@stop

@section('content')
    <h3>Functional Scope <a href="{{ route('functionalscopes.create') }}" class="btn btn-xs btn-default btn-rounded"><i class="fa fa-suitcase m-l-xs m-r-sm"></i>Tambah Functional Scope</a></h3>
    <h4 class="inline text-muted m-t-n">Total <span class="m-l-xl m-r-sm">: </span></h4><h3 class="inline"> {{ Functionalscope::all()->count() }}</h3>
    <section class="panel panel-default">
        <header class="panel-heading">

          <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
        </header>
        <div class="table-responsive">
        {{-- Specify datatable with custom title and first column (id) hidden --}}
        {{ Datatable::table()
            ->addColumn('id','code','title', 'action')
            ->setUrl(route('api.functionalscopes'))
            ->setOptions('bProcessing', true)
            ->setOptions('aoColumnDefs',array(
                array(
                    'bVisible' => false,
                    'aTargets' => [0]
                ),
                array(
                    'sTitle' => 'Kode Functional Scope',
                    'aTargets' => [1]),
                array(
                    'sTitle' => 'Nama Functional Scope',
                    'aTargets' => [2]),
                array(
                    'sTitle' => 'Action',
                    'aTargets' => [3]),
            ))
            ->render('datatable.basic') }}
    </div>
    </section>
@stop

@section('pagejs')
    <script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}" cache="false"></script>
@stop
