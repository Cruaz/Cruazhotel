@extends('Layout')

@section('title', 'Room')

@section('content')
<div class="">
	<div class="position-relative">
		<img src="{{asset('images/Room-1.png')}}" alt="" class=" object-fit-cover d-none d-lg-block img-fluid " style="width: 100%; height: 70vh; filter: brightness(50%)">
		<div class="container position-absolute top-50 start-50 translate-middle text-white text-center">
			<h2 class="display-4 fw-bold">Rooms and Suite</h2>
			<p class="mt-2">Find your most liked room.</p>
		</div>
		<div class="d-none d-md-flex  container mx-auto bg-white position-absolute z-3 rounded row g-3 align-items-center justify-content-center px-5 shadow" style="   position: absolute; right: 0;bottom: -5rem; height:10rem ;left: 0; ">
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
	<div class="container mb-5 text-center" style="margin-top:10rem;">
		<h2 class="display-6 fw-semibold mb-3">CruazHotel’s Room and Suite</h2>
		<div class="divider mx-auto"></div>
		<p class="mt-3 fs-6 w-50 mx-auto">Norem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus,</p>
	</div>
	<div class="container mb-5">
		<div class="row" id="data">
		</div>
	</div>
	<div class="d-flex mt-5 overflow-x-hidden">
		<img src="{{asset('images/Room-2.png')}}" class="card-img-top img-fluid" alt="..." style="width: 380px; height: 250px; object-fit: cover;">
		<img src="{{asset('images/Room-3.png')}}" class="card-img-top img-fluid" alt="..." style="width: 380px; height: 250px; object-fit: cover;">
		<img src="{{asset('images/Room-4.png')}}" class="card-img-top img-fluid" alt="..." style="width: 380px; height: 250px; object-fit: cover;">
		<img src="{{asset('images/Room-5.png')}}" class="card-img-top img-fluid" alt="..." style="width: 380px; height: 250px; object-fit: cover;">
		<img src="{{asset('images/Room-6.png')}}" class="card-img-top img-fluid" alt="..." style="width: 380px; height: 250px; object-fit: cover;">
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
	axios.get('/api/JenisKamar/all')
		.then(response => {
			const data = response.data.data;
			const dataContainer = document.querySelector('#data');
			
			let dataHTML = '';
			data.forEach(Kamar => {
				const firstImage = Kamar.galery.length > 0 ?
                        '/storage/Galery/' + Kamar.galery[0].foto :
                        '/images/Room-all.png';
				dataHTML += `
			<div class="col-md-4 mb-3">
				<div class="card shadow rounded-5">
					<img src="${firstImage}" class="card-img-top img-fluid" alt="..." style="height: 250px; object-fit: cover;">
					<div class="card-body px-4">
						<div class="row mb-3">
							<div class="col-6">
								<p class="card-text">${Kamar.tipe}</p>
							</div>
							<div class="col-6">
								<p class="card-text text-end"><i class="fa-solid fa-user me-2"></i>${Kamar.kapasitas} Adult</p>
							</div>
						</div>
						<h5 class="card-title">${Kamar.nama}</h5>
						<p class="card-text">${Kamar.fasilitas && Kamar.fasilitas.length > 0 ? Kamar.fasilitas[0].nama : 'No fasilitas available'}</p>
					</div>
					<div class="card-footer px-4 bg-white">
						<small class="">IDR ${Number(Kamar.harga).toLocaleString('id-ID')} / Malam</small>
					</div>
					<a href="/DetailRoom?RoomId=${Kamar.id_jenis}" class=" stretched-link"></a>
				</div>
			</div>
			`;

			});
			dataContainer.innerHTML = dataHTML;
		})
		.catch(error => {
			console.error('Error fetching data:', error);
		});
</script>
@endsection