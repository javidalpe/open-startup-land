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
                   {!! Form::model($startup, ['route' => ['startups.update', $startup->id], 'method' => 'patch']) !!}

                        @include('startups.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection