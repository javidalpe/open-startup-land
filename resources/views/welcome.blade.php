<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Fonts -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white">
	<div class="container">

		<a class="navbar-brand" href="{{ url('/') }}">
			{{ config('app.name', 'Laravel') }}
		</a>
		<button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
		        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
		        aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="nav ml-auto">
				@auth
					<li class="nav-item">
						<a class="nav-link" href="{{ url('/home') }}">Home</a>
					</li>
				@else
					<li class="nav-item">
						<a class="nav-link" href="{{ route('login') }}">Login</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{ route('register') }}">Register</a>
					</li>
				@endauth
			</ul>

		</div>
	</div>
</nav>

<div class="container mt-5">
	<div class="row">
		<div class="col-md-6">
			@component('components.card')
				<h5 class="card-title">Top makers:</h5>
				<small class="text-muted">By total monthly revenue</small>
				<dl class="row">
					@foreach($topMakers as $user)
						<dt class="col-8">@include('components.maker')
						</dt>
						<dd class="col-4 text-right">@money($user->monthly_revenue*100, 'USD')
						</dd>
					@endforeach
				</dl>
			@endcomponent
		</div>
		<div class="col-md-6">
			@component('components.card')
				<h5 class="card-title">Top startups:</h5>
				<small class="text-muted">By monthly revenue</small>
				<dl class="row">
					@foreach($topStartups as $metric)
						<dt class="col-8">@include('components.startup', ['startup' => $metric->startup])
						</dt>
						<dd class="col-4 text-right">@money($metric->monthly_revenue*100, $metric->startup->currency)
						</dd>
					@endforeach
				</dl>
			@endcomponent
		</div>
	</div>


	<div class="row">
		<div class="col-md-12 mt-5">
			<p class="lead">Open Startup Land, where makers and startups share their metrics. <a
						href="{{route('register')}}">Join the movemenet.</a></p>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12 mt-5">
			<h5>Startups by name:</h5>
		</div>
		@foreach($startups as $startup)
			<div class="col-md-3">
				@include('components.startup')
			</div>
		@endforeach
	</div>

	<div class="row">
		<div class="col-md-12 mt-5">
			<h5>Creators by name:</h5>
		</div>

		@foreach($makers as $user)
			<div class="col-md-3">
				@include('components.maker')
			</div>
		@endforeach
	</div>

	@include('components.footer')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
