@extends('Layout')

@section('title', 'Detail-Service')

@section('content')


<div class="">
	<div class="position-relative">
		<img src="{{asset('images/Service-1.jpg')}}" alt="" class=" object-fit-cover d-none d-lg-block img-fluid " style="width: 100%; height: 70vh; filter: brightness(50%)">
		<div class="container position-absolute top-50 start-50 translate-middle text-white text-center">
			<h2 class="display-4 fw-bold">Services and Facilities</h2>
			<p class="mt-2">The Details Of a Service</p>
		</div>
		<div class="d-none d-md-flex  container mx-auto bg-white position-absolute z-3 rounded row g-3 align-items-center justify-content-center px-5 shadow" style="   position: absolute; right: 0;bottom: -5rem; height:10rem ;left: 0; ">
			<div class="col-md-10 mt-0">
				<label for="inputEmail4" class="form-label">Select Date</label>
				<input type="date" class="form-control" id="inputEmail4">
			</div>
			<div class="col-md-2 mt-0">
				<a href="{{url('Reserve')}}">
					<button type="button" class="mt-2 px-5 text-white py-2 btn btn-info">Reserve</button>
				</a>
			</div>
		</div>

		<div class="d-block d-md-none">
			<a href="{{url('Reserve')}}">
				<button type="button" class="mt-2 px-5 text-white py-2 btn btn-info">Reserve</button>
			</a>
		</div>
	</div>
	<div id="service-details" class="container" style="margin-top: 10rem;">
	</div>
	<div class="d-flex overflow-x-hidden" id="imagesData" style="margin-top: 10rem;">
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
	const urlParams = new URLSearchParams(window.location.search);
	const serviceId = urlParams.get('ServiceId');

	if (serviceId) {
		axios.get(`/api/JenisService/${serviceId}`)
			.then(response => {
				const service = response.data.data;
				renderServiceDetails(service);
			})
			.catch(error => {
				console.error('Error fetching service details:', error);
				document.getElementById('service-details').innerHTML = '<p>Error loading service details.</p>';
			});
		fetch(`/api/Galery/Data/${serviceId}`)
			.then(response => response.json())
			.then(data => {
				const select = document.getElementById('imagesData');
				data.data.forEach(galeri => {
					const row = `<img src="/storage/Galery/${galeri.foto}" class="card-img-top img-fluid" alt="..." style="width: 380px; height: 250px; object-fit: cover;">`;
					select.innerHTML += row;
				});
			})
			.catch(error => {
				console.error('Error fetching jenis data:', error);
			});
	} else {
		console.error('ServiceId is not provided in the URL.');
	}

	function renderServiceDetails(service) {
		const container = document.getElementById('service-details');
		const firstImage = service.galery.length > 0 ?
                        '/storage/Galery/' + service.galery[0].foto :
                        '/images/Service-all.jpg';
		container.innerHTML = `
        <div class="row align-items-center">
            <div class="d-none d-md-block col-md-6">
                <div class="container-image2 mx-auto">
                    <img src="${firstImage}" alt="" class="w-100 h-100 object-fit-cover d-block img-fluid">
                </div>
            </div>
            <div class="col-12 col-md-6 ps-5">
                <p class="mb-0" style="opacity: 60%;">${service.tipe===1?"Fasilitas":"Kamar"}</p>
                <h2 class="display-4 fw-bold">${service.nama}</h2>
                <div class="divider"></div>
                <p class="mt-2 fs-6 fw-bold">IDR ${Number(service.harga).toLocaleString('id-ID')}</p>
                <p class="mt-2 fs-6">${service.deskripsi}</p>
            </div>
        </div>
        <div class="container mt-5">
            <div class="row">
                <div class="col-3">
                    <h2 class="display-5 fw-bold">Schedule</h2>
                    <ul class="ps-0" style="list-style-type: none;">
                        <li class="mt-4"><i class="fa-solid fa-calendar-days me-3"></i>Mon - Fri : 09:00 - 23:59</li>
                        <li class="mt-4"><i class="fa-solid fa-calendar-days me-3"></i>Sat - Sun : 05:00 - 23:59</li>
                    </ul>
                </div>
                <div class="col-9">
                    <div class="mb-5">
                        <h2 class="display-5 fw-bold">Service Overview</h2>
                        <p class="mt-2 fs-6">${service.ServiceOverview}</p>
                    </div>
                    <div class="mt-3">
                        <h2 class="display-5 fw-bold">Other Fun Facts</h2>
                        <p class="mt-2 fs-6">Norem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus, ut interdum tellus elit sed risus. Maecenas eget condimentum velit, sit amet feugiat lectus. Norem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus, ut interdum tellus elit sed risus. Maecenas eget condimentum velit, sit amet feugiat lectus. Norem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                    </div>
                </div>
            </div>
        </div>
        `;
	}
</script>
@endsection