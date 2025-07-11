@extends('Layout2')

@section('title', 'Login')

@section('content')
<div class="w-75 mx-auto">
	<div class="container mt-5">
		<div class="d-flex justify-content-end align-items-center mb-2 ">
			<h5 class="fw-light">Already have an account?</h5>
			<div class="ms-3">
				<a href="{{url('Login')}}" class="btn btn-outline-dark px-5 py-2">Login</a>
			</div>
		</div>
		<div class="mx-5 mt-2">
			<h2 class="display-5 fw-bold">Welcome to CruazHotel</h2>
			<p class="fw-light" style="opacity: 70%;">Register your account</p>
		</div>
		<form class="mt-2 mx-5" id="registerForm">
			<div class="mb-3">
				<label for="username" class="form-label fw-bold fs-5">Username</label>
				<input type="text" class="form-control p-3 border-info rounded-3 shadow" id="username" name="name" placeholder="Input Your Username.....">
			</div>
			<div class="mb-3">
				<label for="phoneNumber" class="form-label fw-bold fs-5">Phone Number</label>
				<input type="text" class="form-control p-3 border-info rounded-3 shadow" id="phoneNumber" name="noTelp" placeholder="Input Your Phone Number.....">
			</div>
			<div class="mb-3">
				<label for="email" class="form-label fw-bold fs-5">Email</label>
				<input type="email" class="form-control p-3 border-info rounded-3 shadow" id="email" name="email" placeholder="Input Your Email.....">
			</div>
			<div class="mb-3">
				<label for="password" class="form-label fw-bold fs-5">Password</label>
				<input type="password" class="form-control p-3 border-info rounded-3 shadow" id="password" name="password" placeholder="Input Your Password.....">
			</div>
			<button type="submit" class="btn btn-info text-white py-2 px-5 mt-4">Sign Up</button>
		</form>
		<div class="mx-5 mt-2">
			<p class="fw-light" style="opacity: 70%;">Sign Up With</p>
			<div class="fs-1">
				<a data-mdb-ripple-init class="btn btn-outline btn-floating m-1 p-4 rounded-4 shadow-lg " href="#!" role="button"><i class="fab fa-facebook-f fs-2"></i></a>
				<a data-mdb-ripple-init class="btn btn-outline btn-floating m-1 p-4 rounded-4 shadow-lg " href="#!" role="button"><i class="fab fa-twitter fs-2"></i></a>
				<a data-mdb-ripple-init class="btn btn-outline btn-floating m-1 p-4 rounded-4 shadow-lg " href="#!" role="button"><i class="fa-brands fa-google fs-2"></i></a>
			</div>
		</div>
	</div>

</div>
<script>
	document.getElementById('registerForm').addEventListener('submit', function(e) {
		e.preventDefault();
		const formData = new FormData(this);
		fetch('/api/register', {
				method: 'POST',
				body: formData,
			})
			.then(response => response.json())
			.then(data => {
				if (data.message === 'Register Success') {
					console.log('Registration successful!');
					const email = document.getElementById('email').value;
					const password = document.getElementById('password').value;
					fetch('/api/login', {
							method: 'POST',
							headers: {
								'Content-Type': 'application/json',
							},
							body: JSON.stringify({
								email: email,
								password: password
							})
						})
						.then(response => response.json())
						.then(data => {
							if (data.access_token) {
								localStorage.setItem('token', data.access_token);
								console.log('Login successful!');
								if (data.user.role == 0) {
									window.location.href = '/';
								} else {
									window.location.href = '/Dashboard';
								}
							} else {
								console.log(data.message || 'Login failed!');
							}
						})
						.catch(error => console.error('Error:', error));
				} else {
					console.log('Error: ' + data.message);
				}
			})
			.catch(error => {
				console.error('Error:', error);
			});
	});
</script>
@endsection