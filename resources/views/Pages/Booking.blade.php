@extends('Layout')

@section('title', 'Detail-Service')

@section('content')
<div class="">
	<div class="position-relative">
		<img src="{{asset('images/Room-1.png')}}" alt="" class=" object-fit-cover d-none d-lg-block img-fluid " style="width: 100%; height: 55vh; filter: brightness(50%)">
		<div class="d-none d-md-flex  container mx-auto bg-white position-absolute z-3 rounded row g-3 align-items-center justify-content-center px-5 shadow" style="   position: absolute; right: 0;bottom: -5rem; height:10rem ;left: 0; ">
			<div class="col-md-6 mt-0">
				<label for="inputEmail4" class="form-label">Select Checkin</label>
				<input type="date" class="form-control" id="Checkin">
			</div>
			<div class="col-md-6 mt-0">
				<label for="inputEmail4" class="form-label">Select Checkout</label>
				<input type="date" class="form-control" id="Checkout">
			</div>
		</div>

		<div class="d-block d-md-none">
			<button type="button" class="mt-2 px-5 text-white py-2 btn btn-info">Book Now</button>
		</div>
	</div>
	<div class="container mb-5 text-center" style="margin-top:10rem;">
		<h2 class="display-6 fw-semibold mb-3">Pick Your Rooms</h2>
		<div class="divider mx-auto"></div>
		<p class="mt-3 fs-6 w-50 mx-auto">Norem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus,</p>
	</div>
	<div class="container" style="margin-bottom: 5rem;">
		<div class="row">
			<div class="col-9">
				<div class="row align-items-center justify-content-center mx-auto">
					<div class="col-md-9 mt-0">
						<input type="text" class="form-control" placeholder="Search" id="search" oninput="loadRooms(1)">
					</div>
					<div class="col-md-3 mt-0">
						<a href="">
							<button type="button" class="px-5 text-white py-2 btn btn-info"><i class="fa-solid fa-filter me-3"></i>Filter</button>
						</a>
					</div>
				</div>
				<div class="mt-5" id="DataRooms">


				</div>
				<nav aria-label="Page" class="mt-5">
					<ul class="pagination justify-content-center">
						<!-- Pagination links will be dynamically inserted here -->
					</ul>
				</nav>
			</div>
			<div class="col-3">
				<div class="card fixed-bottom sticky-md-top w-100" style=" top: 5rem;">

				</div>
			</div>
		</div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
	let currentPage = 1;
	const perPage = 7;
	let selectedRooms = [];

	function loadRooms(page = 1) {
		const search = document.getElementById('search').value;
		axios.get(`/api/JenisKamar?page=${page}&per_page=${perPage}&search=${search}`)
			.then(response => {
				const data = response.data.data;
				const dataContainer = document.querySelector('#DataRooms');

				let dataHTML = '';
				index = 0;
				data.data.forEach(Kamar => {

					dataHTML += `
                       <div class="card mb-3 w-100" 
					   	data-tipe="${Kamar.tipe}" 
						data-kapasitas="${Kamar.kapasitas}" 
						data-nama="${Kamar.nama}" 
						data-harga="${Kamar.harga}"
						data-id_jenis="${Kamar.id_jenis}"
						data-id="${index}"
						>
							<div class="row g-0 align-items-center">
								<div class="col-md-4">
									<div class="" style="height:40vh; width: 100%;">
										<img src="{{asset('images/alev-takil-lw3Lqe2K7xc-unsplash.jpg')}}" class="object-fit-cover img-fluid w-100 h-100 rounded-start" alt="...">
									</div>
								</div>
								<div class="col-md-8">
									<div class="card-body px-5">
										<div class="d-flex align-items-center justify-content-between">
											<p class=" mb-0" data-tipe="${Kamar.tipe}">${Kamar.tipe}</p>
											<p class=" mb-0"  data-kapasitas="${Kamar.kapasitas}"><i class="fa-solid fa-user me-3"></i>${Kamar.kapasitas} Adult</p>
										</div>
										<h5 class="card-title h2 mb-3 mt-0" data-nama="${Kamar.nama}">${Kamar.nama}</h5>
										<div class="d-flex align-items-center justify-content-between">
											<p data-harga="${Kamar.harga}">IDR ${Number(Kamar.harga).toLocaleString('id-ID')}/Malam</p>
											<p>${Kamar.fasilitas && Kamar.fasilitas.length > 0 ? Kamar.fasilitas[0].nama : 'No fasilitas available'}</p>
										</div>
										<p class="card-text" style="font-size: 0.8rem;">${Kamar.Deskripsi}</p>
										<div class="row align-items-end">
											<div class="col-8">
												<p class="card-text mt-4"><small class="text-body-secondary d-flex flex-wrap">
													<ul class="ps-0" style="list-style-type: none;">
														${Kamar.fasilitas.map((fasilitas, index) => {
															return index !== 0 ? `
																<li class="mt-2 me-4">
																	<i class="fa-solid ${fasilitas.namaIcon} me-3"></i>${fasilitas.nama}
																</li>
															` : '';
														}).join('')}
													</ul>
												</small></p>
											</div>
											<div class="col-4">
												<button class="btn-select btn btn-info text-white fw-medium float-end px-5 py-2">Select</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
                    `;
					index++;
				});


				dataContainer.innerHTML = dataHTML;


				updatePagination(response.data);
			})
			.catch(error => {
				console.error('Error fetching data:', error);
			});
	}


	document.addEventListener('click', (e) => {
		if (e.target && e.target.classList.contains('btn-select')) {

			let roomData = e.target.closest('.card').dataset;
			selectedRooms.push(roomData);
			console.log(roomData.id);
			updateSummary();
		}
	});

	function calculateNights() {
		const selectedDateCheckin = document.querySelector('#Checkin').value;
		const selectedDateCheckout = document.querySelector('#Checkout').value;
		if (!selectedDateCheckin || !selectedDateCheckout) {
			return 0; 
		}
		const checkinDate = new Date(selectedDateCheckin);
		const checkoutDate = new Date(selectedDateCheckout);
		const timeDifference = checkoutDate - checkinDate; 
		const nights = Math.ceil(timeDifference / (1000 * 60 * 60 * 24)); 
		return nights > 0 ? nights : 0; 
	}

	function updateSummary() {
		const nights = calculateNights();
		let totalHarga = selectedRooms.reduce((sum, room) => sum + parseInt(room.harga), 0);

		let summaryElement = document.querySelector('.card.fixed-bottom');
		summaryElement.innerHTML = `
		<div class="card-body px-4 py-5">
        <h5 class="card-title">IDR ${totalHarga.toLocaleString('id-ID')} Total</h5>
        <div class="d-flex justify-content-between border-bottom">
            <h6 class="card-subtitle text-body-secondary pb-2">${selectedRooms.length} Rooms</h6>
            <h6 class="card-subtitle text-body-secondary pb-2">${nights} Nights</h6>
        </div>
        <div class="border-bottom mt-3">
            ${selectedRooms.map(room => `
                <div class="row">
                    <div class="col-10">
                        <p class="card-text"><strong>${room.tipe} - ${room.nama || ''}</strong></p>
                    </div>
                    <div class="col-2">
                        <p class="card-text text-end" onclick="removeRoom(${room.id})"><i class="fa-solid fa-trash"></i></p>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <p class="text-body-secondary fw-light">${nights} Night(s)</p>
                    </div>
                    <div class="col-6">
                        <p class="text-body-secondary fw-light text-end">IDR ${parseInt(room.harga).toLocaleString('id-ID')}</p>
                    </div>
                </div>
            `).join('')}
        </div>
        <div class="row mt-3">
            <div class="col-5">
                <p class="fw-bold mb-0">Total</p>
                <p class="mt-0 pb-2">${selectedRooms.length} Rooms</p>
            </div>
            <div class="col-7">
                <h5 class="fs-5 fw-bold text-end">IDR ${totalHarga.toLocaleString('id-ID')}</h5>
            </div>
        </div>
        <div class="text-center mb-4">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="paymentMethod" id="creditDebit" value="Credit/Debit">
                <label class="form-check-label" for="creditDebit">Credit/Debit</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="paymentMethod" id="eWallet" value="E-Wallet">
                <label class="form-check-label" for="eWallet">E-Wallet</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="paymentMethod" id="cash" value="Cash">
                <label class="form-check-label" for="cash">Cash</label>
            </div>
        </div>
        <a href="#" class="btn btn-info text-white w-100" onclick="submitBooking()">Reserve</a>
		</div>
    `;
	}

	document.querySelector('#Checkin').addEventListener('change', updateSummary);
	document.querySelector('#Checkout').addEventListener('change', updateSummary);
	function removeRoom(roomId) {
		selectedRooms = selectedRooms.filter(room => room.id != roomId);
		updateSummary();
	}
	function submitBooking() {
		const selectedDateCheckin = document.querySelector('#Checkin').value;
		const selectedDateCheckout = document.querySelector('#Checkout').value;
		if (!selectedDateCheckin || !selectedDateCheckout) {
			alert('Please select check-in and check-out dates.');
			return;
		}
		const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked');
		if (!paymentMethod) {
			alert('Please select a payment method.');
			return;
		}
		const bookingData = {
			CheckIn: selectedDateCheckin,
			CheckOut: selectedDateCheckout,
			Status: 'Booked',
			diskon: 10,
			Data: selectedRooms.map(room => ({
				id_jenisses: room.id_jenis, 
			})),
		};
		console.log('Submitting booking:', JSON.stringify(bookingData));
		const token = localStorage.getItem('token');
		fetch('/api/Booking', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
					'Authorization': `Bearer ${token}` 
				},
				body: JSON.stringify(bookingData),
			})
			.then(response => response.json())
			.then(data => {
				console.log('Server response:', data);
				if (data.message === 'Booking Added Successfully') {
					alert('Booking successful!');
				} else {
					console.error('Error:', data);
					alert('Booking failed: ' + JSON.stringify(data.message));
				}
			})
			.catch(error => {
				console.error('Fetch error:', error);
				alert('An error occurred during booking.');
			});
	}


	function updatePagination(paginationData) {
		let paginationHTML = '';


		paginationHTML += `
		<li class="page-item rounded shadow me-3 border-0 ${paginationData.current_page === 1 ? 'disabled' : ''}">
			<a class="page-link rounded text-black fw-bold border-0" href="#" aria-label="Previous" onclick="loadRooms(${paginationData.current_page - 1})">
				<span aria-hidden="true">&laquo;</span>
			</a>
		</li>`;


		if (paginationData.last_page > 1) {
			for (let i = 1; i <= paginationData.last_page; i++) {
				paginationHTML += `
					<li class="page-item rounded shadow me-3 border-0 ${paginationData.current_page === i ? 'active' : ''}">
						<a class="page-link rounded text-black fw-bold border-0" href="#" onclick="loadRooms(${i})">${i}</a>
					</li>`;
			}
		} else {
			paginationHTML += `
				<li class="page-item rounded shadow me-3 border-0 active">
					<a class="page-link rounded text-black fw-bold border-0" href="#" onclick="loadRooms(1)">1</a>
				</li>`
		}


		paginationHTML += `
				<li class="page-item rounded shadow me-3 border-0 ${paginationData.current_page === paginationData.last_page ? 'disabled' : ''}">
					<a class="page-link rounded text-black fw-bold border-0" href="#" aria-label="Next" onclick="loadRooms(${paginationData.current_page + 1})">
						<span aria-hidden="true">&raquo;</span>
					</a>
				</li>`;


		const paginationContainer = document.querySelector('.pagination');
		if (paginationContainer) {
			paginationContainer.innerHTML = paginationHTML;
		} else {
			console.error('Pagination container not found');
		}
	}
	loadRooms(currentPage);
</script>
@endsection