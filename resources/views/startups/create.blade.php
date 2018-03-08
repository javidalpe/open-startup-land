@extends('layouts.dashboard')

@section('container')
    <section class="content-header">
        <h1>
            Startup
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'startups.store']) !!}

                        @include('startups.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
