<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Startup Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Speech Field -->
<div class="form-group col-sm-6">
    {!! Form::label('speech', 'Speech:') !!}
    {!! Form::text('speech', null, ['class' => 'form-control']) !!}
    <small class="form-text text-muted">Describe the startup. Max 140 char.</small>
</div>

<!-- Website Field -->
<div class="form-group col-sm-6">
    {!! Form::label('website', 'Website:') !!}
    {!! Form::text('website', null, ['class' => 'form-control']) !!}
</div>

<!-- Currency Field -->
<div class="form-group col-sm-6">
    {!! Form::label('currency', 'Currency:') !!}
    {!! Form::select('currency', ['USD' => 'USD', 'EUR' => 'EUR', 'GBP' => 'GBP'], null, ['class' => 'form-control']) !!}
    <small class="form-text text-muted">Currency to show at charts</small>
</div>

<!-- Api Endpoint Field -->
<div class="form-group col-sm-6">
    {!! Form::label('api_endpoint', 'Your metrics Api Endpoint:') !!}
    {!! Form::text('api_endpoint', null, ['class' => 'form-control']) !!}
    <small class="form-text text-muted">Where we will get your metrics every day. Must return a JSON with <i>{{App\Metric::MONTHLY_REVENUE}}</i>, <i>{{App\Metric::PAID_USERS}}</i> and <i>{{App\Metric::FREE_USERS}}</i>.</small>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('startups.index') !!}" class="btn btn-secondary">Cancel</a>
</div>
