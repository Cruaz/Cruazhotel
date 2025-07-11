@extends('AdminLayout')

@section('title', 'Booking')

@section('content')

<div class="">
	<div class="container-fluid">

		<div class="card" style="height:80vh;">
			<div class="card-body p-4">
				<div class="d-flex justify-content-between">
					<div class="d-flex align-items-center">
						<h5 class="card-title h2">Booking</h5>
						<div class="dropdown ms-3">
							<button id="items-per-page-btn" class="btn btn-outline-info text-black dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
								7
							</button>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="#" onclick="changeItemsPerPage(7)">7</a></li>
								<li><a class="dropdown-item" href="#" onclick="changeItemsPerPage(10)">10</a></li>
								<li><a class="dropdown-item" href="#" onclick="changeItemsPerPage(20)">20</a></li>
							</ul>
						</div>
					</div>
					<a href="">
						<button type="button" class="px-4 text-white py-2 btn btn-info"><i class="fa-solid fa-filter me-3"></i>Filter</button>
					</a>
				</div>

				<table class=" table w-100 text-center">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">ID User</th>
							<th scope="col">Checkin - Checkout</th>
							<th scope="col">Status</th>
							<th scope="col">Total Harga</th>
							<th scope="col">Jumlah Kamar</th>
							<th scope="col">ID Kamar</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody class="table-group-divider" id="table-body">
					</tbody>
				</table>
				<nav aria-label="Page" class="mt-5">
					<ul class="pagination justify-content-end" id="pagination">

					</ul>
				</nav>
			</div>
		</div>
	</div>


	<!-- Modal insertq -->
	<div class="modal fade" id="modalInsert" tabindex="-1" aria-labelledby="modalInsertLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="modalInsertLabel">Insert Data</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="" id="submitFormInsert">
					<div class="modal-body">
						<div class="mb-3">
							<select class="form-select" aria-label="User" name="id_users">
								<option selected hidden value="">Select User</option>
							</select>
						</div>
						<div class="mb-3">
							<select class="form-select" aria-label="Kamar" name="Status">
								<option selected hidden value="">Select Status</option>
								<option value="Booked">Booked</option>
								<option value="CheckedIn">CheckedIn</option>
								<option value="CheckedOut">CheckedOut</option>
							</select>
						</div>
						<div class="mb-3">
							<select class="form-select" aria-label="Kamar" name="id_kamars">
								<option selected hidden value="">Select Kamar</option>
							</select>
						</div>
						<div class="mb-3">
							<label for="Date" class="form-label">Check In</label>
							<input type="Date" class="form-control" id="DateIn" placeholder="input Date" name="CheckIn">
						</div>
						<div class="mb-3">
							<label for="Date" class="form-label">Check Out</label>
							<input type="Date" class="form-control" id="DateOut" placeholder="input Date" name="CheckOut">
						</div>
						<div class="mb-3">
							<label for="totalHarga" class="form-label">total Harga</label>
							<input type="number" class="form-control" id="totalHarga" placeholder="input totalHarga" name="total_harga">
						</div>
						<div class="mb-3">
							<label for="Diskon" class="form-label">Diskon</label>
							<input type="number" class="form-control" id="Diskon" placeholder="input Diskon" name="diskon">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-info text-white">Save changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Modal Update -->
	<div class="modal fade" id="modalUpdate" tabindex="-1" aria-labelledby="modalUpdateLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="modalUpdateLabel">Update Data</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="" id="submitFormUpdate">
					<div class="modal-body">
						<div class="mb-3">
							<select class="form-select" aria-label="User" id="id_usersUpdate" name="id_users">
								<option selected hidden value="">Select User</option>
							</select>
						</div>
						<div class="mb-3">
							<select class="form-select" aria-label="Kamar" id="StatusUpdate" name="Status">
								<option selected hidden value="">Select Status</option>
								<option value="Booked">Booked</option>
								<option value="CheckedIn">CheckedIn</option>
								<option value="CheckedOut">CheckedOut</option>
							</select>
						</div>
						<div class="mb-3">
							<select class="form-select" aria-label="Kamar" id="id_kamarsUpdate" name="id_kamars">
								<option selected hidden value="">Select Kamar</option>
							</select>
						</div>
						<div class="mb-3">
							<label for="Date" class="form-label">Check In</label>
							<input type="Date" class="form-control" id="DateInUpdate" placeholder="input Date" name="CheckIn">
						</div>
						<div class="mb-3">
							<label for="Date" class="form-label">Check Out</label>
							<input type="Date" class="form-control" id="DateOutUpdate" placeholder="input Date" name="CheckOut">
						</div>
						<div class="mb-3">
							<label for="totalHarga" class="form-label">total Harga</label>
							<input type="number" class="form-control" id="totalHargaUpdate" placeholder="input totalHarga" name="total_harga">
						</div>
						<div class="mb-3">
							<label for="Diskon" class="form-label">Diskon</label>
							<input type="number" class="form-control" id="DiskonUpdate" placeholder="input Diskon" name="diskon">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-info text-white">Save changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Modal Delete -->
	<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="modalDeleteLabel">Delete Data</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="" id="submitFormDelete">
					<div class="modal-body">
						<input type="hidden" class="form-control" id="idDelete" value="" name="id_kamar">
						<h6>Apakah Anda Yakin Ingin Menghapus ID <span id="showdelete"></span>?</h6>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
						<button type="submit" class="btn btn-info text-white">Ya</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
	let perPage = 7;
	const token = localStorage.getItem('token');
	function truncate(text, maxLength) {
		return text.length > maxLength ? text.substring(0, maxLength) + "..." : text;
	}
	function changeItemsPerPage(newPerPage) {
		perPage = newPerPage;
		document.getElementById('items-per-page-btn').innerText = newPerPage;
		fetchData(1, perPage);
	}
	function fetchData(page = 1, itemsPerPage = perPage) {
		const search = document.getElementById('search').value;
		axios.get(`/api/Booking?page=${page}&per_page=${itemsPerPage}&search=${search}`, {
				headers: {
					'Authorization': `Bearer ${token}`
				}
			})
			.then(response => {
				const data = response.data.data;
				const tableBody = document.getElementById('table-body');
				const pagination = document.getElementById('pagination');
				tableBody.innerHTML = '';
				pagination.innerHTML = '';
				data.data.forEach(Booking => {
					const roomCount = Booking.kamar.length;
					const kamarTruncated = Booking.kamar
						.slice(0, 2)
						.map(kamar => `L${kamar.lantai}R${kamar.id_kamar}`)
						.join(', ') + (Booking.kamar.length > 2 ? '...' : '');
					const kamarFull = Booking.kamar
						.map(kamar => `<li class="px-2">L${kamar.lantai}R${kamar.id_kamar}</li>`)
						.join('');
					const row = `
                        <tr class="mt-5 shadow">
                            <td>${Booking.id_booking}</td>
							<td>${Booking.id_users}</td>
                            <td>${Booking.CheckIn} - ${Booking.CheckOut}</td>
                            <td>${Booking.Status}</td>
                            <td>${Booking.total_harga}</td>
							<td>${roomCount}</td>
							 <td>
							<div class="dropdown-center">
                    <a class="btn dropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        ${kamarTruncated}
                    </a>
                    <ul class="dropdown-menu">
                        <div class="d-flex flex-wrap">
                            ${kamarFull}
                        </div>
                    </ul>
                </div>
							</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn dropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item update-btn" href="#modalUpdate" data-bs-toggle="modal" data-bs-target="#modalUpdate">Update</a></li>
                                        <li><a class="dropdown-item text-danger delete-btn" href="#modalDelete" data-bs-toggle="modal" data-bs-target="#modalDelete">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    `;
					tableBody.innerHTML += row;
				});
				for (let i = 1; i <= data.last_page; i++) {
					pagination.innerHTML += `
                        <li class="page-item rounded shadow me-3 border-0 ${i === data.current_page ? 'active' : ''}">
                            <a class="page-link rounded text-black fw-bold border-0 " href="#" onclick="fetchData(${i})">${i}</a>
                        </li>
                    `;
				}
			})
			.catch(error => {
				console.error('Error fetching data:', error);
			});
	}
	document.addEventListener('DOMContentLoaded', () => {
		fetchData();
	});
	document.getElementById('submitFormInsert').addEventListener('submit', function(e) {
		const formData = new FormData(this);
		axios.post('/api/Booking/dashboard', formData, {
				headers: {
					'Authorization': `Bearer ${token}`
				}
			})
			.then(response => {
				console.log(response.data);
			})
			.catch(error => {
				console.error('There was an error submitting the form:', error);
			});
	});
	document.getElementById('modalInsert').addEventListener('shown.bs.modal', function() {
		fetch('/api/Kamar/all', {
				headers: {
					'Authorization': `Bearer ${token}`
				}
			})
			.then(response => response.json())
			.then(data => {
				const select = document.querySelector('select[name="id_kamars"]');
				select.innerHTML = '<option selected hidden>Select Kamar</option>';
				data.data.forEach(item => {
					const option = document.createElement('option');
					option.value = item.id_kamar;
					option.textContent = `L${item.lantai}R${item.id_kamar}`;
					select.appendChild(option);
				});
			})
			.catch(error => {
				console.error('Error fetching jenis data:', error);
			});
		fetch('/api/User/all', {
				headers: {
					'Authorization': `Bearer ${token}`
				}
			})
			.then(response => response.json())
			.then(data => {
				const select = document.querySelector('select[name="id_users"]');
				select.innerHTML = '<option selected hidden value="">Select Users</option>';
				data.data.forEach(item => {
					const option = document.createElement('option');
					option.value = item.id_user;
					option.textContent = item.id_user + " | " + item.name;
					select.appendChild(option);
				});
			})
			.catch(error => {
				console.error('Error fetching jenis data:', error);
			});
	});
	var idKamar, idUser;
	document.getElementById('modalUpdate').addEventListener('shown.bs.modal', function() {
		fetch('/api/Kamar/all', {
				headers: {
					'Authorization': `Bearer ${token}`
				}
			})
			.then(response => response.json())
			.then(data => {
				const select = document.getElementById('id_kamarsUpdate');
				select.innerHTML = '<option selected hidden value="">Select Kamar</option>';
				data.data.forEach(item => {
					const option = document.createElement('option');
					option.value = item.id_kamar;
					option.textContent = `L${item.lantai}R${item.id_kamar}`;
					select.appendChild(option);
				});

				const select2 = document.getElementById('id_kamarsUpdate');
				const options2 = Array.from(select2.options);
				const selectedOption2 = options2.find(option => option.value === idKamar);
				if (selectedOption2) {
					select2.value = idKamar;
				}
			})
			.catch(error => console.error('Error fetching jenis data:', error));
		fetch('/api/User/all', {
				headers: {
					'Authorization': `Bearer ${token}`
				}
			})
			.then(response => response.json())
			.then(data => {
				const select = document.getElementById('id_usersUpdate');
				select.innerHTML = '<option selected hidden value="">Select Users</option>';
				data.data.forEach(item => {
					const option = document.createElement('option');
					option.value = item.id_user;
					option.textContent = item.id_user + " | " + item.name;
					select.appendChild(option);
				});

				const select1 = document.getElementById('id_usersUpdate');
				const options1 = Array.from(select1.options);
				const selectedOption1 = options1.find(option => option.value === idUser);
				if (selectedOption1) {
					select1.value = idUser;
				}
			})
			.catch(error => console.error('Error fetching jenis data:', error));
	});

	document.querySelector('tbody').addEventListener('click', function(event) {
		if (event.target && event.target.classList.contains('update-btn')) {
			const button = event.target;
			const row = button.closest('tr');
			const id = row.querySelector('td:nth-child(1)').textContent.trim();
			idUser = row.querySelector('td:nth-child(2)').textContent.trim();
			const idKamarCell = row.querySelector('td:nth-child(7)').textContent.trim();
			idKamar = idKamarCell.split(',')[0].split('R')[1].trim();
			console.log('idKamar:', idKamar);
			const dateRangeCell = row.querySelector('td:nth-child(3)').textContent.trim();
			const [dateIn, dateOut] = dateRangeCell.split(' - ').map(date => date.trim());
			const Status = row.querySelector('td:nth-child(4)').textContent.trim();
			const TotalHarga = row.querySelector('td:nth-child(5)').textContent.trim();
			document.getElementById('StatusUpdate').value = Status;
			document.getElementById('totalHargaUpdate').value = TotalHarga;
			document.getElementById('DateInUpdate').value = dateIn;
			document.getElementById('DateOutUpdate').value = dateOut;
			document.getElementById('DiskonUpdate').value = 10;
			document.getElementById('submitFormUpdate').dataset.id = id;
		}
	});

	document.getElementById('submitFormUpdate').addEventListener('submit', function(e) {
		const formData = new FormData(this);
		const id = this.dataset.id;
		console.log(formData);
		axios.post('/api/Booking/dashboard/' + id, formData, {
				headers: {
					'Authorization': `Bearer ${token}`
				}
			})
			.then(response => {
				console.log(response.data);
			})
			.catch(error => {
				console.error('There was an error submitting the form:', error);
			});
	});

	document.querySelector('tbody').addEventListener('click', function(event) {
		if (event.target && event.target.classList.contains('delete-btn')) {
			const button = event.target;
			const row = button.closest('tr');
			const id = row.querySelector('td:nth-child(1)').textContent.trim();
			console.log(id);
			document.getElementById('showdelete').textContent = id;
			document.getElementById('idDelete').value = id;
			document.getElementById('submitFormDelete').dataset.id = id;
		}
	});
	document.getElementById('submitFormDelete').addEventListener('submit', function(e) {
		const formData = new FormData(this);
		const id = this.dataset.id;
		console.log(formData);
		axios.delete(`/api/Booking/${id}`, {
				headers: {
					'Authorization': `Bearer ${token}`,
				},
				params: formData,
			})
			.then(response => {
				console.log(response.data);
			})
			.catch(error => {
				console.error('There was an error submitting the form:', error);
			});
	});
</script>
@endsection