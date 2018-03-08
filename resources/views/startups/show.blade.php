@extends('layouts.dashboard')

@section('container')
    <section class="content-header">
        <h1>
            Startup
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('startups.show_fields')
                    <a href="{!! route('startups.index') !!}" class="btn btn-light" role="button">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
