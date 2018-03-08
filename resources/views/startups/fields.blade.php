<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Speech Field -->
<div class="form-group col-sm-6">
    {!! Form::label('speech', 'Speech:') !!}
    {!! Form::text('speech', null, ['class' => 'form-control']) !!}
</div>

<!-- Website Field -->
<div class="form-group col-sm-6">
    {!! Form::label('website', 'Website:') !!}
    {!! Form::text('website', null, ['class' => 'form-control']) !!}
</div>

<!-- Api Endpoint Field -->
<div class="form-group col-sm-6">
    {!! Form::label('api_endpoint', 'Api Endpoint:') !!}
    {!! Form::text('api_endpoint', null, ['class' => 'form-control']) !!}
</div>

<!-- Currency Field -->
<div class="form-group col-sm-6">
    {!! Form::label('currency', 'Currency:') !!}
    {!! Form::select('currency', ['USD' => 'USD', 'EUR' => 'EUR'], null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('startups.index') !!}" class="btn btn-default">Cancel</a>
</div>
