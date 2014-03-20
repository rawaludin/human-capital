@section('pagecss')

@stop

@section('breadcrumb')
    <li><a href="{{ route('functionalscopes.index') }}">Functional Scope</a></li>
    <li class="active">Tambah Functional Scope</li>
@stop

@section('content')
    <div class="m-b-md">
        <h3 class="m-b-none">Tambah Functional Scope</h3>
    </div>
    <section class="panel panel-default">
        <header class="panel-heading font-bold">
            Silahkan lengkapi form berikut.
        </header>
    <div class="panel-body">
    {{ Form::open(array('url' => route('functionalscopes.store'), 'method' => 'post',
        'role' => 'form', 'class'=>'form-horizontal', 'parsley-validate', 'novalidate')) }}
        <div class="form-group">
            {{ Form::label('code', 'Kode Functional Scope', array('class'=>'col-sm-2 control-label')) }}
            <div class="col-sm-10">
            {{ Form::text('code', null, array(
                'class' => 'form-control',
                'placeholder' => 'FSxx',
                'parsley-required' => 'true',
                'parsley-remote' => route('api.functionalscopes.validate')
                )) }}
            </div>
        </div>
        <div class="line line-dashed line-lg pull-in"></div>
        <div class="form-group">
            {{ Form::label('title', 'Nama Functional Scope', array('class'=>'col-sm-2 control-label')) }}
            <div class="col-sm-10">
            {{ Form::text('title', null, array(
                'class' => 'form-control',
                'placeholder' => '',
                'parsley-required' => 'true',
                'parsley-remote' => route('api.functionalscopes.validate')
                )) }}
            </div>
        </div>
        <div class="line line-dashed line-lg pull-in"></div>
        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-2">
                {{ Form::submit('Simpan Functional Scope', array('class' => 'btn btn-primary m-r-sm')) }}
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
    <script>
    $(function() {
        // trigger validation
        $( 'form' ).parsley('validate');
    });
    </script>
@stop
