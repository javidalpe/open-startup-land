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
	{!! Form::url('website', null, ['class' => 'form-control']) !!}
</div>

<!-- Currency Field -->
<div class="form-group col-sm-6">
	{!! Form::label('currency', 'Currency:') !!}
	{!! Form::select('currency', ['USD' => 'USD', 'EUR' => 'EUR', 'GBP' => 'GBP'], null, ['class' => 'form-control']) !!}
	<small class="form-text text-muted">Currency in wich you are operating.</small>
</div>

<!-- Api Endpoint Field -->
<div class="form-group col-sm-6">
	{!! Form::label('api_endpoint', 'Your metrics Api Endpoint:') !!}
	{!! Form::url('api_endpoint', null, ['class' => 'form-control']) !!}
	<small class="form-text text-muted">Where we will get your metrics every day. <a class="" data-toggle="collapse" href="#collapse" aria-expanded="false" aria-controls="collapse">
			Read more
		</a>
	</small>

	<div class="collapse" id="collapse">
		<div class="card card-body">
			<p>
				You must provide a simple http endpoint where we can get your metrics every morning. The endpoint must return a valid JSON like this one:
			</p>
			<p>
				<samp>{"monthly_revenue":234,"paid_users":43,"free_users":7801}</samp>
			</p>

		</div>
	</div>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
	{!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
	<a href="{!! route('startups.index') !!}" class="btn btn-secondary">Cancel</a>
</div>
