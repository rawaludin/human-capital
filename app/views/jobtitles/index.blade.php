@section('pagecss')
    <link rel="stylesheet" href="{{ asset('js/datatables/datatables.css') }}" type="text/css" cache="false"/>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
@stop

@section('breadcrumb')
    <li><a href="#">Job Title</a></li>
@stop

@section('content')
    <h3>Job Title <a href="{{ route('jobtitles.create') }}" class="btn btn-xs btn-default btn-rounded"><i class="fa fa-suitcase m-l-xs m-r-sm"></i>Tambah Job Title</a></h3>
    <h4 class="inline text-muted m-t-n">Total <span class="m-l-xl m-r-sm">: </span></h4><h3 class="inline"> {{ Jobtitle::all()->count() }}</h3>
    <section class="panel panel-default">
        <header class="panel-heading">

          <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
        </header>
        <div class="table-responsive">
        {{-- Specify datatable with custom title and first column (id) hidden --}}
        {{ Datatable::table()
            ->addColumn('id', 'code', 'title', 'jobprefix', 'functionalscope', 'status', 'action')
            ->setUrl(route('api.jobtitles'))
            ->setOptions('bProcessing', true)
            ->setOptions('aoColumnDefs',array(
                array(
                    "bSortable" => false,
                    'sTitle' => 'No',
                    'aTargets' => [0]
                ),
                array(
                    'sTitle' => 'Kode Job Title',
                    'aTargets' => [1]),
                array(
                    'sTitle' => 'Nama Job Title',
                    'aTargets' => [2]),
                array(
                    'sTitle' => 'Nama Job Prefix',
                    'aTargets' => [3]),
                array(
                    'sTitle' => 'Nama Functional Scope',
                    'aTargets' => [4]),
                array(
                    'sTitle' => 'Status Aktif',
                    'aTargets' => [5]),
                array(
                    'sTitle' => 'Action',
                    'aTargets' => [6]),
            ))
            ->render('datatable.basic') }}
    </div>
    </section>
@stop

@section('pagejs')
    <script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}" cache="false"></script>
    <script>
    $(function() {
        $('#DataTables_Table_0_length').css('display','inline-block');
        $('<div id="filter_status" class="dataTables_length" style="display: inline-block;"><label>Saring berdasarkan <select size="1" name="filter_status" aria-controls="filter_status"><option value="all" selected="selected">Semua</option><option value="active">Aktif</option><option value="non-active">Tidak Aktif</option></select></label></div>').insertAfter('#DataTables_Table_0_length');
        $('select[name="filter_status"]').change(function() {
            var $oTable = $('#DataTables_Table_0').dataTable();
            switch (this.value) {
                case 'all' :
                    $oTable.fnFilter('');
                    break;
                case 'active' :
                    $oTable.fnFilter('checked="checked"', null, false, true, false, true);
                    break;
                case 'non-active' :
                    $oTable.fnFilter('<input disabled="disabled" name="status" type="checkbox" value="status">', null, false, true, false, true);
                    break;
            }
        });
    });
    </script>
@stop
