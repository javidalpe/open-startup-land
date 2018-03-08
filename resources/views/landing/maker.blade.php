@extends('layouts.dashboard')

@section('container')
	<div class="row mt-5">
		<div class="col-md-4">
			@component('components.card')
				<h5 class="card-subtitle text-muted">Total monthly revenue:</h5>
				<h1 class="card-title">@money($user->monthly_revenue*100, $currency)
					<small>/month</small>
				</h1>
			@endcomponent
		</div>
		<div class="col-md-4">
			@component('components.card')
				<h5 class="card-subtitle text-muted">Total free users:</h5>
				<h1 class="card-title">{{$user->free_users}}</h1>
			@endcomponent
		</div>
		<div class="col-md-4">
			@component('components.card')
				<h5 class="card-subtitle text-muted">Total paid users:</h5>
				<h1 class="card-title">{{$user->paid_users}}</h1>
			@endcomponent
		</div>
	</div>

	<div class="row">
		<div class="col-md-12 mt-5">
			<h5>{{$user->name}}'s startups:</h5>
			<ul class="list-unstyled">
				@foreach($startups as $startup)
				<li><a href="{{route('landing.startup', [$startup->id, str_slug($startup->name)])}}">{{$startup->name}}</a> <small class="text-muted">{{$startup->speech}}</small></li>
				@endforeach
			</ul>
		</div>
	</div>
@endsection