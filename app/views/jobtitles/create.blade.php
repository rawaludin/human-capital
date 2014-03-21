@section('pagecss')
    <link rel="stylesheet" href="{{ asset('js/select2/select2.css') }}" type="text/css" cache="false" />
@stop

@section('breadcrumb')
    <li><a href="{{ route('jobtitles.index') }}">Job Title</a></li>
    <li class="active">Tambah Job Title</li>
@stop

@section('content')
    <div class="m-b-md">
        <h3 class="m-b-none">Tambah Job Title</h3>
    </div>
    <section class="panel panel-default">
        <header class="panel-heading font-bold">
            Silahkan lengkapi form berikut.
        </header>
    <div class="panel-body">
    {{ Form::open(array('url' => route('jobtitles.store'), 'method' => 'post',
        'role' => 'form', 'class'=>'form-horizontal', 'parsley-validate', 'novalidate')) }}
        <div class="form-group">
            {{ Form::label('jobprefix_id', 'Nama Job Prefix', array('class'=>'col-sm-2 control-label')) }}
            <div class="col-sm-10">
                <div class="m-b">
                    {{ Form::select('jobprefix_id', array(''=>'')+Jobprefix::lists('title','id'), null, array(
                        'id'=>'jobprefix_id',
                        'placeholder' => "Pilih nama job prefix",
                        'parsley-required' => 'true',
                        'class' => 'jobtitleSource',
                        'style'=>'width:100%')) }}
                </div>
            </div>
        </div>
        <div class="line line-dashed line-lg pull-in"></div>
        <div class="form-group">
            {{ Form::label('functionalscope_id', 'Nama Functional Scope', array('class'=>'col-sm-2 control-label')) }}
            <div class="col-sm-10">
                <div class="m-b">
                    {{ Form::select('functionalscope_id', array(''=>'')+Functionalscope::lists('title','id'), null, array(
                        'id'=>'functionalscope_id',
                        'placeholder' => "Pilih nama functional scope",
                        'parsley-required' => 'true',
                        'class' => 'jobtitleSource',
                        'style'=>'width:100%')) }}
                </div>
            </div>
        </div>
        <div class="line line-dashed line-lg pull-in"></div>
        <div class="form-group">
            {{ Form::label('code', 'Kode Job Title', array('class'=>'col-sm-2 control-label')) }}
            <div class="col-sm-10">
            {{ Form::text('code', null, array(
                'class' => 'form-control',
                'placeholder' => 'JTxx',
                'parsley-required' => 'true',
                'parsley-remote' => route('api.jobtitles.validate')
                )) }}
            </div>
        </div>
        <div class="line line-dashed line-lg pull-in"></div>
        <div class="form-group">
            {{ Form::label('title', 'Nama Job Title', array('class'=>'col-sm-2 control-label')) }}
            <div class="col-sm-10">
            {{ Form::text('title', null, array(
                'class' => 'form-control',
                'placeholder' => '',
                'parsley-required' => 'true',
                'parsley-remote' => route('api.jobtitles.validate')
                )) }}
            </div>
        </div>
        <div class="line line-dashed line-lg pull-in"></div>
        <div class="form-group">
            {{ Form::label('status', 'Status Aktif', array('class'=>'col-sm-2 control-label')) }}
            <div class="col-sm-10 m-b-sm">
                <div class="checkbox">
                    {{ Form::checkbox('status', 1, true) }}
                </div>
            </div>
        </div>
        <div class="line line-dashed line-lg pull-in"></div>
        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-2">
                {{ Form::submit('Simpan Job Title', array('class' => 'btn btn-primary m-r-sm')) }}
                <a href="{{ $previousUrl }}">Pembatalan</a>
            </div>
        </div>
    {{ Form::close() }}
    </div>
    </section>
@stop

@section('pagejs')
    <!-- parsley -->
    <script src="{{ asset('js/parsley/parsley.min.js')}}" cache="false"></script>
    <script src="{{ asset('js/parsley/parsley.extend.js')}}" cache="false"></script>
    <!-- select2 -->
    <script src="{{ asset('js/select2/select2.min.js') }}" cache="false"></script>
    <script>
    $(function() {
        // trigger validation
        $( 'form' ).parsley('validate');
        // select2
        $("#jobprefix_id").select2();
        $("#functionalscope_id").select2();
        // generate job title
        $('.jobtitleSource').change(function() {
            var jobPrefix = $('#jobprefix_id option:selected').text();
            var functionalScope = $('#functionalscope_id option:selected').text();
            var jobTitle = jobPrefix + ' ' + functionalScope;
            $('#title').val(jobTitle);
            // trigger validation
            $('#title').change();
        });
    });
    </script>



@stop
