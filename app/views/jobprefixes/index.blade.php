@section('pagecss')
    <link rel="stylesheet" href="{{ asset('js/datatables/datatables.css') }}" type="text/css" cache="false"/>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
@stop

@section('breadcrumb')
    <li><a href="#">Job Prefix</a></li>
@stop

@section('content')
    <h3>Job Prefix <a href="{{ route('jobprefixes.create') }}" class="btn btn-xs btn-default btn-rounded"><i class="fa fa-suitcase m-l-xs m-r-sm"></i>New Job Prefix</a></h3>
    <h4 class="inline text-muted m-t-n">Total <span class="m-l-xl m-r-sm">: </span></h4><h3 class="inline"> {{ Jobprefix::all()->count() }}</h3>

@stop

@section('pagejs')
    <script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}" cache="false"></script>
@stop
