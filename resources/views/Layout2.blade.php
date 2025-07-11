<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>CruazHotel - @yield('title')</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet" crossorigin="anonymous">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>

	<div class="row g-0">
		<div class="col-4 position-relative">
			<div class="position-absolute z-1 mt-5 mx-5 mb-0">
				<a href="{{url('/')}}" class="text-decoration-none text-white" style="font-size: 1.25rem;">
					<img src="{{asset('Logo.svg')}}" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
					CruazHotel
				</a>
			</div>
			<div id="carouselExampleIndicators" class="carousel slide " data-bs-ride="carousel">
				<div class="carousel-inner">
					<div class="carousel-item active">
						<img src="{{asset('images/Hotel-11.jpg')}}" class="object-fit-cover d-block w-100 vh-100 img-fluid" style="filter: brightness(50%)" alt="{{asset('images/images.jpg')}}">
					</div>
					<div class="carousel-item">
						<img src="{{asset('images/Hotel-12.jpg')}}" class="object-fit-cover d-block w-100 vh-100 img-fluid" style="filter: brightness(50%)" alt="{{asset('images/images.jpg')}}">
					</div>
					<div class="carousel-item">
						<img src="{{asset('images/Hotel-13.jpg')}}" class="object-fit-cover d-block w-100 vh-100 img-fluid" style="filter: brightness(50%)" alt="{{asset('images/images.jpg')}}">
					</div>
				</div>
				<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
					<span class="carousel-control-prev-icon" hidden aria-hidden="true"></span>
				</button>
				<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
					<span class="carousel-control-next-icon" hidden aria-hidden="true"></span>
				</button>
			</div>
		</div>

		<div class="col-8">
			@yield('content')
		</div>
	</div>
</body>

</html>