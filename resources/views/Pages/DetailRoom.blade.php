@extends('Layout')

@section('title', 'Detail-Service')

@section('content')


<div class="">
	<div class="position-relative">
		<img src="{{asset('images/Room-1.png')}}" alt="" class=" object-fit-cover d-none d-lg-block img-fluid " style="width: 100%; height: 70vh; filter: brightness(50%)">
		<div class="container position-absolute top-50 start-50 translate-middle text-white text-center">
			<h2 class="display-4 fw-bold">Rooms and Suite</h2>
			<p class="mt-2">The Details Of a Rooms</p>
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

	<div id="Room-details" class="container" style="margin-top: 10rem;">
	</div>
	<div class="d-flex overflow-x-hidden" id="imagesData" style="margin-top: 10rem;">
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
	const urlParams = new URLSearchParams(window.location.search);
	const RoomId = urlParams.get('RoomId');

	if (RoomId) {
		axios.get(`/api/JenisKamar/${RoomId}`)
			.then(response => {
				const Room = response.data.data;
				renderRoomDetails(Room);
			})
			.catch(error => {
				console.error('Error fetching Room details:', error);
				document.getElementById('Room-details').innerHTML = '<p>Error loading Room details.</p>';
			});
		fetch(`/api/Galery/Data/${RoomId}`)
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
		console.error('RoomId is not provided in the URL.');
	}

	function renderRoomDetails(Room) {
		const container = document.getElementById('Room-details');
		const firstImage = Room.galery.length > 0 ?
                        '/storage/Galery/' + Room.galery[0].foto :
                        '/images/Room-all.png';
		container.innerHTML = `
         <div class="container" style="margin-top: 10rem;">
        <div class="row align-items-center">
            <div class="d-none d-md-block col-md-6">
                <div class="container-image2 mx-auto">
                    <img src="${firstImage}" alt="" class="w-100 h-100 object-fit-cover d-block img-fluid">
                </div>
            </div>
            <div class="col-12 col-md-6 ps-5">
                <p class="mb-0" style="opacity: 60%;">${Room.tipe}</p>
                <h2 class="display-4 fw-bold">${Room.nama}</h2>
                <div class="divider"></div>
                <p class="mt-2 fs-6 fw-bold">IDR ${Number(Room.harga).toLocaleString('id-ID')} / Malam</p>
                <p class="mt-2 fs-6">${Room.Deskripsi}</p>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="row mt-5">
            <div class="col-3">
                <h2 class="display-5 fw-bold">Addition</h2>
                <ul class="ps-0" style="list-style-type: none;">
                    ${Room.fasilitas && Room.fasilitas.length > 0 
                        ? Room.fasilitas.map(fasilitas => `
                            <li class="mt-4">
                                <i class="fa-solid me-3 ${fasilitas.namaIcon}"></i>${fasilitas.nama}
                            </li>
                        `).join('') 
                        : '<li>No fasilitas available</li>'
                    }
                </ul>
            </div>
            <div class="col-9">
                <div class="mb-5">
                    <h2 class="display-5 fw-bold">Room Overview</h2>
                    <p class="mt-2 fs-6">${Room.KamarOverview}</p>
                </div>
                <div class="mb-5">
                    <h2 class="display-5 fw-bold">House Rules</h2>
                    <p class="mt-2 fs-6">Norem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus, ut interdum tellus elit sed risus. Maecenas eget condimentum velit, sit amet feugiat lectus. Norem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus, ut interdum tellus elit sed risus. Maecenas eget condimentum velit, sit amet feugiat lectus. Norem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                </div>
                <div class="mt-3">
                    <h2 class="display-5 fw-bold">Children And Extra Beds</h2>
                    <p class="mt-2 fs-6">Norem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus, ut interdum tellus elit sed risus. Maecenas eget condimentum velit, sit amet feugiat lectus. Norem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus, ut interdum tellus elit sed risus. Maecenas eget condimentum velit, sit amet feugiat lectus. Norem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                </div>
            </div>
        </div>
    </div>
        `;
	}
</script>
@endsection