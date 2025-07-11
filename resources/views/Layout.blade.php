<!DOCTYPE html>
<html lang="en" data-bs-theme="lignt">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cruaz - @yield('title')</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet" crossorigin="anonymous">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
	<nav id="navbar" class="navbar navbar-expand-lg py-3 fixed-top bg-body-transparent text-white navbar-dark">
		<div class="container-fluid px-5">
			<a class="navbar-brand mb-0 h1" href="#">
				<img src="{{asset('Logo.svg')}}" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
				CruazHotel
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarText">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto nav-underline">
					<li class="nav-item">
						<a class="nav-link {{ (request()->is('/')) ? 'active' : '' }}" href="{{url('/')}}">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link {{ (request()->is('Rooms')) ? 'active' : '' }}" href="{{url('Rooms')}}">Rooms</a>
					</li>
					<li class="nav-item">
						<a class="nav-link {{ (request()->is('Service')) ? 'active' : '' }}" href="{{url('Service')}}">Services</a>
					</li>
					<li class="nav-item">
						<a class="nav-link {{ (request()->is('About')) ? 'active' : '' }}" href="{{url('About')}}">About</a>
					</li>
				</ul>
				<div class="d-flex align-items-center">
					<div class="one-quarter me-4" id="switch">
						<input type="checkbox" class="checkbox" id="chk" aria-labelledby="bd-color-mode" role="switch"
							id="flexSwitchCheckChecked"
							checked
							onclick="ToggleSwitch()" />
						<label class="label" for="chk">
							<div class="ball"></div>
						</label>
					</div>
					<a href="{{url('Login')}}" id="loginButton" class="">
						<button class="btn btn-outline-light px-5 py-2" id="loginBtn">Login</button>
					</a>
					<a href="{{ url('Profile') }}" id="profileLink" style="display: none;">
						<img src="" alt="Profile Picture" id="profilePic" class="rounded-circle" width="40" height="40">
					</a>
				</div>
			</div>
		</div>
	</nav>

	<div class="w-100 h-100">
		@yield('content')
	</div>

	<footer class="text-center text-lg-start bg-body-tertiary text-muted">
		<section class="">
			<div class="container text-center text-md-start mt-5">
				<div class="row mt-3">
					<div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
						<h6 class="fs-5 fw-bold mb-4">
							<img src="{{asset('Logo.svg')}}" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">CruazHotel
						</h6>
						<p>
							Here you can use rows and columns to organize your footer content. Lorem ipsum
							dolor sit amet, consectetur adipisicing elit.
						</p>
						<div class="">
							<div>
								<a data-mdb-ripple-init class="btn btn-outline btn-floating m-1 rounded-circle shadow " href="#!" role="button"><i class="fab fa-facebook-f"></i></a>
								<a data-mdb-ripple-init class="btn btn-outline btn-floating m-1 rounded-circle shadow " href="#!" role="button"><i class="fab fa-twitter"></i></a>
								<a data-mdb-ripple-init class="btn btn-outline btn-floating m-1 rounded-circle shadow " href="#!" role="button"><i class="fab fa-instagram"></i></a>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
						<h6 class=" fw-bold mb-4 fs-5 ">
							Useful links
						</h6>
						<p>
							<a href="#!" class="text-reset text-decoration-none">Rooms</a>
						</p>
						<p>
							<a href="#!" class="text-reset text-decoration-none">Service</a>
						</p>
						<p>
							<a href="#!" class="text-reset text-decoration-none">About Us</a>
						</p>
						<p>
							<a href="#!" class="text-reset text-decoration-none">Login</a>
						</p>
					</div>
					<div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
						<h6 class=" fw-bold mb-4 fs-5 ">Contact</h6>
						<p><i class="fa-solid fa-location-pin me-3"></i>Jl. Babarsari No.43, Janti, Caturtunggal, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281</p>
						<p>
							<i class="fas fa-envelope me-3"></i>
							CruazHotel@gmail.com
						</p>
						<p><i class="fas fa-phone me-3"></i>+62 812-6806-4567</p>
					</div>
				</div>
			</div>
		</section>
		<div class="text-center p-4">
			Copyright ©2024 All right reverved to Cruaz
		</div>
	</footer>
	<script src="{{ asset('js/Script.js') }}"></script>
</body>
<script>
	document.addEventListener("DOMContentLoaded", function() {
		const token = localStorage.getItem('token');
		if (token) {
			fetch('/api/UserData', { 
					method: 'GET',
					headers: {
						'Authorization': `Bearer ${token}`
					}
				})
				.then(response => response.json())
				.then(data => {
					if (data.message === "User of "+data.data.name+" Retrieved") {
						const user = data.data;
						console.log(user);
						const profilePicUrl = user.foto==null?"{{asset('images/null.jpg')}}":`/storage/profile/${user.foto}`;
						document.getElementById('profilePic').src = profilePicUrl;
						document.getElementById('profileLink').style.display = 'inline-block';
						document.getElementById('loginButton').style.display = 'none';
					}
				})
				.catch(error => console.error('Error fetching profile:', error));
		} else {
			document.getElementById('loginButton').style.display = 'inline-block';
			document.getElementById('profileLink').style.display = 'none';
		}
	});
</script>

</html>