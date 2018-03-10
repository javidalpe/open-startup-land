@extends('layouts.dashboard')

@section('container')
    <section class="content-header">
        <h1>
            New Startup
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                    {!! Form::open(['route' => 'startups.store']) !!}

                        @include('startups.fields')

                    {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
