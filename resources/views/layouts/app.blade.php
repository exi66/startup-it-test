<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ asset('css/bootstrap-utilities.css') }}">
		<link rel="stylesheet" href="{{ asset('css/style.css') }}">

		<title>@yield('title')</title>
	</head>
	<body>
		<div class="main-wrapper">
			<div class="content">
				<nav class="navbar navbar-expand-lg navbar-light bg-light">
					<div class="container">
						<a class="navbar-brand" href="#">Test</a>
						<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
								aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<div class="collapse navbar-collapse" id="navbarNav">
							<ul class="navbar-nav">
								<li class="nav-item">
									<a class="nav-link" aria-current="page" href="{{ route('materials.list') }}">Материалы</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="{{ route('tag.list') }}">Теги</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="{{ route('category.list') }}">Категории</a>
								</li>
							</ul>
						</div>
					</div>
				</nav>
				<div class="container">
					@if (count($errors) > 0)
					<div class="alert alert-danger mt-3">
						<strong>Ошибка!</strong> Возникла ошибка при вводе данных.<br>
						<ul>
						   @foreach ($errors->all() as $error)
							 <li>{{ $error }}</li>
						   @endforeach
						</ul>
					</div>
					@endif
					@if ($message = Session::get('success'))
					<div class="alert alert-success mt-3">
						<p>{{ $message }}</p>
					</div>
					@endif
					@if ($message = Session::get('warn'))
					<div class="alert alert-warning mt-3">
						<p>{{ $message }}</p>
					</div>
					@endif
					
					@yield('content')
				</div>
			</div>
			<footer class="footer py-4 mt-5 bg-light">
				<div class="container">
					<div class="row">
						<div class="col text-muted">Test</div>
					</div>
				</div>
			</footer>
			@stack('scripts')
		</div>
	</body>
</html>