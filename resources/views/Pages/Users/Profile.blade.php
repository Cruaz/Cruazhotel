@extends('Userlayout')

@section('title', 'Profile')

@section('contentUser')
<div class="container">
	<div class="col-12">
		<div class="card mb-3 w-100 px-5 py-3">
			<div class="row g-0 align-items-center" id="dataProfile">


			</div>
		</div>
		<div class="row">
			<div class="col-3">
				<div class="card w-100 rounded-4">
					<div class="card-body p-5">
						<div class="d-flex justify-content-between">
							<h5 class="card-title">Booked Rooms</h5>
							<h5 class="card-title"><i class="fa-solid fa-door-open"></i></h5>
						</div>
						<h3 class="mb-2 h1  mt-3" id="BookingText"></h3>
						<p class="card-text text-body-secondary mt-3">Lorem Ipsum Dor adawa</p>
					</div>
				</div>
			</div>
			<div class="col-3">
				<div class="card w-100 rounded-4">
					<div class="card-body p-5">
						<div class="d-flex justify-content-between">
							<h5 class="card-title">Reserved Service</h5>
							<h5 class="card-title"><i class="fa-solid fa-bell-concierge"></i></h5>
						</div>
						<h3 class="mb-2 h1  mt-3" id="ReservationText"></h3>
						<p class="card-text text-body-secondary mt-3">Lorem Ipsum Dor adawa</p>
					</div>
				</div>
			</div>
			<div class="col-6">
				<div class="card w-100">
					<div class="card-body p-5">
						<div class="d-flex justify-content-between">
							<h5 class="card-title">On Going Orders</h5>
							<h5 class="card-title"><i class="fa-solid fa-arrows-rotate"></i></h5>
						</div>
						<table class=" table w-100">
							<thead>
								<tr>
									<th scope="col">User</th>
									<th scope="col">Tipe</th>
									<th scope="col">Date</th>
									<th scope="col">Status</th>
									<th scope="col">Total Harga</th>
								</tr>
							</thead>
							<tbody class="table-group-divider" id="table-body">

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
	<script>
		const token = localStorage.getItem('token');
	
		function UserData() {
			axios.get(`/api/UserData`, {
					headers: {
						'Authorization': `Bearer ${token}`
					}
				})
				.then(response => {
					const data = response.data.data;
					const dataContainer = document.querySelector('#dataProfile');

					let dataHTML = '';
					console.log(data);
					const profilePicUrl = data.foto==null?"{{asset('images/null.jpg')}}":`/storage/profile/${data.foto}`;
					dataHTML += `
                       <div class="col-md-2">
							<img src="${profilePicUrl}" class="img-fluid rounded-circle object-fit-cover" style="height:10rem; width:10rem;">
						</div>
						<div class="col-md-10">
							<div class="card-body" >
								<div class="d-flex justify-content-between">
									<h5 class="card-title h1">${data.name}</h5>
									<a href="{{url('Edit')}}" class=" text-center btn btn-info text-white px-4 py-2" ><i class="fa-solid fa-pen-to-square me-2"></i>Edit</a>	
								</div>
								<div class="d-flex flex-wrap" style="width: 25rem;">
									<p class="card-text mb-0 mt-2 me-4"><i class="fa-solid fa-envelope me-3"></i>${data.email}</p>
									<p class="card-text mb-0 mt-2 me-4"><i class="fa-solid fa-phone me-2"></i>${data.noTelp}</p>
								</div>
								
							</div>
						</div>
						<div class="col-12 border border-danger rounded px-4 py-3 mt-4">
							<p><i class="fa-solid fa-circle-exclamation me-3 mt-3"></i>Jl. Norem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec Norem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec Norem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec Norem ipsum dolor sit amet</p>
						</div>
                    `;;


					dataContainer.innerHTML = dataHTML;
				})
				.catch(error => {
					console.error('Error fetching data:', error);
				});
			fetch('/api/User/BookingPesanan', {
					headers: {
						'Authorization': `Bearer ${token}`
					}
				})
				.then(response => response.json())
				.then(data => {
					const tableBody = document.querySelector('tbody');
					data.data.data.forEach(item => {
						const row = `
                <tr class="mt-5 shadow">
                    <td>${item.type === 'Booking' ? item.id_booking: item.id_pemesanan}</td>
                    <td>${item.type}</td>
                    <td>${item.type === 'Booking' ? item.CheckIn : item.Tgl_pemesanan}</td>
                    <td>${item.Status}</td>
                    <td>${item.total_harga}</td>
                </tr>
            `;
						tableBody.insertAdjacentHTML('beforeend', row);
					});
				})
				.catch(error => {
					console.error('Error fetching data:', error);
				});
			fetch('/api/Booking/User/Count', {
					headers: {
						'Authorization': `Bearer ${token}`
					}
				})
				.then(response => response.json())
				.then(data => {
					const select = document.getElementById('BookingText');
					select.textContent = data.count;
				})
				.catch(error => {
					console.error('Error fetching jenis data:', error);
				});
			fetch('/api/Pemesanan/User/Count', {
					headers: {
						'Authorization': `Bearer ${token}`
					}
				})
				.then(response => response.json())
				.then(data => {
					const select = document.getElementById('ReservationText');
					select.textContent = data.count;
				})
				.catch(error => {
					console.error('Error fetching jenis data:', error);
				});
		}
		UserData();
	</script>
	@endsection