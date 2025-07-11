@extends('Layout')

@section('title', 'About')

@section('content')
<style>

</style>
<div class="container--fluid">
	<div class="position-relative">
		<img src="{{asset('images/Hotel-6.png')}}" alt="" class=" object-fit-cover d-none d-lg-block img-fluid " style="width: 100%; height: 70vh; filter: brightness(50%)">
		<div class="container position-absolute top-50 start-50 translate-middle text-white text-center">
			<h2 class="display-4 fw-bold">A Small Details About Us</h2>
			<p class="mt-2">Norem ipsum dolor sit amet, consectetur adipiscing elit. </p>
		</div>
	</div>

	<div class="container mt-5 align-content-center" style="height: 80vh;">
		<div class="row align-items-center">
			<div class="d-none d-md-block col-md-6">
				<div class="container-image  mx-auto">
					<img src="{{asset('images/Hotel-4.png')}}" alt="" class="images object-fit-cover d-block img-fluid ">
				</div>
			</div>
			<div class="col-12 col-md-6">
				<p class="mb-0" style="opacity: 60%;">A Small Story</p>
				<h2 class="display-4 fw-bold">About Us</h2>
				<div class="divider"></div>
				<p class="mt-2 fs-6">Norem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus, ut interdum tellus elit sed risus. Maecenas eget condimentum velit, sit amet feugiat lectus </p>
				<p class="mt-2 fs-6">Norem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus, ut interdum tellus elit sed risus. Maecenas eget condimentum velit, sit amet feugiat lectus </p>
			</div>
		</div>
	</div>

	<div class="container text-center mb-5 position-relative  align-content-center" style="width: 100%; height: 60vh;">
		<h2 class="display-6 fw-semibold mb-3">Our Mission</h2>
		<div class="divider mx-auto"></div>
		<p class="mt-3 fs-6">Norem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus, ut interdum tellus elit sed risus. Maecenas eget condimentum velit, sit amet feugiat lectus. Norem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus, ut interdum tellus elit sed risus. Maecenas eget condimentum velit, sit amet feugiat lectus. Norem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus, ut interdum tellus elit sed risus. Maecenas eget condimentum velit, sit amet feugiat lectus. Norem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus, ut interdum tellus elit sed risus. Maecenas eget condimentum velit, sit amet feugiat lectus. </p>
	</div>
	<div class=" position-relative mb-5" style="width: 100%; height: 25vh;">
		<img src="{{asset('images/Hotel-1.png')}}" alt="" class=" object-fit-cover d-none d-lg-block img-fluid " style="width: 100%; height: 25vh; filter: brightness(50%)">
		<div class="container-fluid h-100 position-absolute z-0 top-0 align-content-center">
			<div class=" w-100 bg-transparent ">
				<div class="text-center text-white">
					<h2 class="display-6 mt-3 fw-semibold">We Have</h2>
					<div class="divider mx-auto"></div>
					<div class="row text-center mt-5 align-items-center  " style="opacity: 90%;">
						<div class="col-lg-4 ">
							<p class="fs-5 ">A Beautiful View</p>
						</div>
						<div class="col-lg-4 ">
							<p class="fs-5 ">An Unique Architechture</p>
						</div>
						<div class="col-lg-4">
							<p class="fs-5 ">Some Signature Amenitiesnce</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container text-center mb-5 position-relative  align-content-center" style="width: 100%; height: 60vh;">
		<div class="">
			<i class="fa-solid fa-star"></i>
			<i class="fa-solid fa-star fs-3"></i>
			<i class="fa-solid fa-star fs-1"></i>
			<i class="fa-solid fa-star fs-3"></i>
			<i class="fa-solid fa-star"></i>
		</div>
		<h2 class="display-6 fw-semibold mb-3">Awarded as the best Hotel In Narnia</h2>
		<p class="mt-3 fs-6">Norem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus, ut interdum tellus elit sed risus. Maecenas eget condimentum velit, sit amet feugiat lectus. Norem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus, ut interdum tellus elit sed risus. Maecenas eget condimentum velit, sit amet feugiat lectus. Norem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus, ut interdum tellus elit sed risus. Maecenas eget condimentum velit, sit amet feugiat lectus. Norem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus, ut interdum tellus elit sed risus. Maecenas eget condimentum velit, sit amet feugiat lectus. </p>
		<p class="mt-3 fs-6"><em>“Gentry Marvelo Jusuf - AAC“</em></p>
	</div>
	<div class="w-100">
	<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15812.392512673185!2d110.4161291!3d-7.7794195!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a59f1fb2f2b45%3A0x20986e2fe9c79cdd!2sUniversitas%20Atma%20Jaya%20Yogyakarta%20-%20Kampus%203%20Gedung%20Bonaventura%20Babarsari!5e0!3m2!1sen!2sid!4v1729403090247!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" class="w-100" referrerpolicy="no-referrer-when-downgrade"></iframe>
	</div>
</div>

@endsection