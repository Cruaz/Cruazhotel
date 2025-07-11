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
		<form class="mt-5 mx-5"  action="{{url('NewPass')}}">
			<div class="mb-3">
				<label for="formGroupExampleInput" class="form-label fw-bold fs-5 ">Email</label>
				<input type="Email" class="form-control p-3 border-info rounded-3 shadow" id="formGroupExampleInput" placeholder="Input Your Email.....">
			</div>
			<button type="submit" class="btn btn-info text-white py-2 px-5 mt-5">Confirm</button>
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

@endsection