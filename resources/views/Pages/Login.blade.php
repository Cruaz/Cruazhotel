@extends('Layout2')

@section('title', 'Login')

@section('content')
<div class="w-75 mx-auto">
	<div class="container mt-5">
		<div class="d-flex justify-content-end align-items-center mb-5">
			<h5 class="fw-light">Doesn’t have an account?</h5>
			<div class="ms-3">
				<a href="{{url('SignUp')}}" class="btn btn-outline-dark px-5 py-2">Sign Up</a>
			</div>
		</div>
		<div class="mx-5 mt-5">
			<h2 class="display-5 fw-bold">Welcome to CruazHotel</h2>
			<p class="fw-light" style="opacity: 70%;">Log In to your account</p>
		</div>
		<form id="loginForm" class="mt-5 mx-5">
			<div class="mb-3">
				<label for="formGroupExampleInput" class="form-label fw-bold fs-5 mt-3">Email</label>
				<input type="email" class="form-control p-3 border-info rounded-3 shadow" id="formGroupExampleInput" name="email" placeholder="Input Your Email.....">
			</div>
			<div class="mb-3">
				<label for="formGroupExampleInput2" class="form-label fw-bold fs-5 mt-3">Password</label>
				<input type="password" class="form-control p-3 border-info rounded-3 shadow" id="formGroupExampleInput2" name="password" placeholder="Input Your Password.....">
				<a href="{{ url('/Forgoten') }}">Forgot Password?</a>
			</div>
			<button type="submit" class="btn btn-info text-white py-2 px-5 mt-5">Sign in</button>
		</form>

		<div class="mx-5 mt-5">
			<p class="fw-light" style="opacity: 70%;">Log In With</p>
			<div class="fs-1">
				<a data-mdb-ripple-init class="btn btn-outline btn-floating m-1 p-4 rounded-4 shadow-lg " href="#!" role="button"><i class="fab fa-facebook-f fs-2"></i></a>
				<a data-mdb-ripple-init class="btn btn-outline btn-floating m-1 p-4 rounded-4 shadow-lg " href="#!" role="button"><i class="fab fa-twitter fs-2"></i></a>
				<a data-mdb-ripple-init class="btn btn-outline btn-floating m-1 p-4 rounded-4 shadow-lg " href="#!" role="button"><i class="fa-brands fa-google fs-2"></i></a>
			</div>
		</div>
	</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
	const form = document.getElementById('loginForm');
	form.addEventListener('submit', function(e) {
		e.preventDefault();
		const email = document.getElementById('formGroupExampleInput').value;
		const password = document.getElementById('formGroupExampleInput2').value;
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
					const role = Number(data.user.role);
					if(role==0){
						window.location.href = '/'; 
					}else{
						window.location.href = '/Dashboard';
					}
				} else {
					console.log(data.message || 'Login failed!');
				}
			})
			.catch(error => console.error('Error:', error));
	});
</script>
@endsection