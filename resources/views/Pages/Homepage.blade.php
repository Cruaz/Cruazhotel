@extends('Layout')

@section('title', 'Homepage')

@section('content')
<div class="">
	<!-- Carousel -->
	<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
		<div class="carousel-indicators" style="bottom: 5rem;">
			<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active rounded" aria-current="true" aria-label="Slide 1"></button>
			<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" class="rounded" aria-label="Slide 2"></button>
			<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" class="rounded" aria-label="Slide 3"></button>
		</div>

		<div class="carousel-inner">
			<div class="carousel-item active">

				<img src="{{asset('images/Hotel-5.png')}}" class="object-fit-cover d-block w-100 vh-100 img-fluid" style="filter: brightness(50%)" alt="{{asset('images/Hotel-.png')}}">
				<div class="carousel-caption d-none d-md-block text-wrap">
					<h1 class="display-1 fw-bold">Experience Something New Everyday</h1>
					<button type="button" class="mt-5 px-5 text-white py-2 btn btn-info">Learn More</button>
				</div>
			</div>
			<div class="carousel-item">
				<img src="{{asset('images/Hotel-6.png')}}" class="object-fit-cover d-block w-100 vh-100 img-fluid" style="filter: brightness(50%)" alt="{{asset('images/Hotel-.png')}}">
				<div class="carousel-caption d-none d-md-block text-wrap">
					<h1 class="display-1 fw-bold">See More Shit Everyday</h1>
					<button type="button" class="mt-5 px-5 text-white py-2 btn btn-info">Learn More</button>
				</div>
			</div>
			<div class="carousel-item">
				<img src="{{asset('images/Hotel-7.png')}}" class="object-fit-cover d-block w-100 vh-100 img-fluid" style="filter: brightness(50%)" alt="{{asset('images/Hotel-.png')}}">
				<div class="carousel-caption d-none d-md-block text-wrap">
					<h1 class="display-1 fw-bold">Enjoy Your Time Here With US</h1>
					<button type="button" class="mt-5 px-5 text-white py-2 btn btn-info">Learn More</button>
				</div>
			</div>
		</div>
		<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
			<span class="carousel-control-prev-icon" hidden aria-hidden="true"></span>
		</button>
		<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
			<span class="carousel-control-next-icon" hidden aria-hidden="true"></span>
		</button>

		<div class="d-none d-md-flex  container mx-auto bg-white position-absolute z-3 rounded row g-3 align-items-center justify-content-center px-5" style="   position: absolute; right: 0;bottom: -5rem; height:10rem ;left: 0; ">
			<div class="col-md-5 mt-0">
				<label for="inputEmail4" class="form-label">Select Checkin</label>
				<input type="date" class="form-control" id="Checkin">
			</div>
			<div class="col-md-5 mt-0">
				<label for="inputEmail4" class="form-label">Select Checkout</label>
				<input type="date" class="form-control" id="Checkout">
			</div>
			<div class="col-md-2 mt-0">
				<a href="{{url('Booking')}}">
					<button type="button" class="mt-2 px-5 text-white py-2 btn btn-info">Book Now</button>
				</a>
			</div>
		</div>

		<div class="d-block d-md-none">
			<a href="{{url('Booking')}}">
				<button type="button" class="mt-2 px-5 text-white py-2 btn btn-info">Book Now</button>
			</a>
		</div>
	</div>
	<!-- About Us -->
	<div class="container mt-5 align-content-center" style="height: 80vh;">
		<div class="row align-items-center">
			<div class="d-none d-md-block col-md-6">
				<div class="container-image  mx-auto">
					<img src="{{asset('images/Hotel-4.png')}}" alt="" class="images object-fit-cover d-block img-fluid ">
				</div>
			</div>
			<div class="col-12 col-md-6">
				<h2 class="display-4 fw-bold">About Us</h2>
				<div class="divider"></div>
				<p class="mt-2">Norem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus, ut interdum tellus elit sed risus. Maecenas eget condimentum velit, sit amet feugiat lectus. </p>
				<button type="button" class="mt-2 px-5 text-white py-2 btn btn-info">Learn More</button>
			</div>
		</div>
	</div>
	<!-- Our Facilities -->
	<div class="position-relative mb-5" style="width: 100%; height: 25vh;">
		<img src="{{asset('images/Hotel-3.png')}}" alt="" class=" object-fit-cover d-none d-lg-block img-fluid position-absolute" style="width: 100%; height: 25vh;">
		<div class="container">
			<div class="card position-absolute text-white" style="width:70vh;right: 20vh; bottom: -8vh; background-color: #1EB7AF;">
				<div class="card-body p-5">
					<h5 class="card-title display-6 fw-bold">Our Facilities</h5>
					<h6 class="card-subtitle fs-5 mb-2 fw-light " style="opacity: 80%;">Norem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus.</h6>
					<div class="row mt-3">
						<ul class="col-6 " style="list-style-type: none; ">
							<li class="mt-3"><i class="fa-solid fa-water-ladder me-3"></i>Swimming Pool</li>
							<li class="mt-3"><i class="fa-solid fa-spa me-3"></i>Spa & Message</li>
							<li class="mt-3"><i class="fa-solid fa-mug-saucer me-3"></i>Breakfast</li>
							<li class="mt-3"><i class="fa-solid fa-key me-3"></i>Smart Key</li>
						</ul>
						<ul class="col-6 " style="list-style-type: none; ">
							<li class="mt-3"><i class="fa-solid fa-dumbbell me-3"></i>Gym & Yoga</li>
							<li class="mt-3"><i class="fa-solid fa-microphone me-3"></i>Conference Room</li>
							<li class="mt-3"><i class="fa-solid fa-wifi me-3"></i>Wi-Fi Internet</li>
							<li class="mt-3"><i class="fa-solid fa-bed me-3"></i>Room Service</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Pricing -->
	<div class="container mt-5 mb-5" style="height: 80vh;">
		<h2 class="display-4 fw-bold mb-3">Our Room Types</h2>
		<div class="divider mb-5"></div>
		<div class="container mt-5">
			<div class="row gy-5 gy-lg-0 gx-xl-5 align-items-center">
				<div class="col-12 col-lg-4">
					<div class="card border-0 shadow">
						<div class="card-body p-4 p-xxl-5">
							<h2 class="h4 mb-2 text-center"><i class="fa-solid fa-face-smile"></i></h2>
							<h4 class="display-5 fw-bold mb-5 text-center">Single</h4>

							<ul class="list-group list-group-flush mb-5">
								<li class="list-group-item text-center text-secondary">
									<span>Adult : 2</span>
								</li>
								<li class="list-group-item text-center text-secondary">
									<span> Size: 50m2</span>
								</li>
								<li class="list-group-item text-center text-secondary">

									<span>Bed Type : Single</span>
								</li>
								<li class="list-group-item text-center text-secondary">

									<span>Additions : Breakfast, Lunch,....</span>
								</li>
							</ul>
							<p class="mb-3 mt-5 text-center fw-bold">Rp 500.000</p>
							<div class=" text-center">
								<a href="#!">
									<button type="button" class="btn btn-info text-white py-2 px-5">Book Now</button>
								</a>
							</div>

						</div>
					</div>
				</div>
				<div class="col-12 col-lg-4">
					<div class="card border-0 shadow-lg pt-md-4 pb-md-4 bsb-pricing-popular">
						<div class="card-body p-4 p-xxl-5">
							<h2 class="h4 mb-2 text-center"><i class="fa-solid fa-crown"></i></h2>
							<h4 class="display-5 fw-bold mb-5 text-center">Luxury</h4>

							<ul class="list-group list-group-flush mb-5">
								<li class="list-group-item text-center text-secondary">
									<span>Adult : 2</span>
								</li>
								<li class="list-group-item text-center text-secondary">
									<span> Size: 60m2</span>
								</li>
								<li class="list-group-item text-center text-secondary">

									<span>Bed Type : Luxury</span>
								</li>
								<li class="list-group-item text-center text-secondary">

									<span>Additions : Food, access,....</span>
								</li>
							</ul>
							<p class="mb-3 mt-5 text-center fw-bold">Rp 500.000</p>
							<div class=" text-center">
								<a href="#!">
									<button type="button" class="btn btn-info text-white py-2 px-5">Book Now</button>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-4">
					<div class="card border-0 shadow">
						<div class="card-body p-4 p-xxl-5">
							<h2 class="h4 mb-2 text-center"><i class="fa-solid fa-user-group"></i></h2>
							<h4 class="display-5 fw-bold mb-5 text-center">Family</h4>

							<ul class="list-group list-group-flush mb-5">
								<li class="list-group-item text-center text-secondary">
									<span>Adult: 4</span>
								</li>
								<li class="list-group-item text-center text-secondary">
									<span> Size: 60m2</span>
								</li>
								<li class="list-group-item text-center text-secondary">
									<span>Bed Type : Double Bed</span>
								</li>
								<li class="list-group-item text-center text-secondary">
									<span>Additions : Breakfast, Lunch,....</span>
								</li>
							</ul>
							<p class="mb-3 mt-5 text-center fw-bold">Rp 500.000</p>
							<div class=" text-center">
								<a href="#!">
									<button type="button" class="btn btn-info text-white py-2 px-5">Book Now</button>
								</a>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Divider Footer -->
	<div class=" position-relative mb-5" style="width: 100%; height: 25vh;">
		<img src="{{asset('images/Hotel-1.png')}}" alt="" class=" object-fit-cover d-none d-lg-block img-fluid position-absolute z-0" style="width: 100%; height: 25vh; filter: brightness(50%)">
		<div class="container-fluid g-0 h-100">
			<div class="card w-100 bg-transparent rounded-0 border-0 h-100">
				<div class="card-body">
					<div class="row text-center align-items-center h-100 text-white">
						<div class="col-lg-3 border-end">
							<h3 class="display-4 fw-bold ">30</h3>
							<p class="fs-4 ">Rooms</p>
						</div>
						<div class="col-lg-3 border-end">
							<h3 class="display-4 fw-bold ">210</h3>
							<p class="fs-4 ">Satisfied Customer</p>
						</div>
						<div class="col-lg-3 border-end">
							<h3 class="display-4 fw-bold ">30</h3>
							<p class="fs-4 ">Services</p>
						</div>
						<div class="col-lg-3">
							<h3 class="display-4 fw-bold ">10</h3>
							<p class="fs-4 ">Years Of Experience</p>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
@endsection