@extends('AdminLayout')

@section('title', 'Pemesanan')

@section('content')

<div class="">
	<div class="container-fluid">

		<div class="card" style="height:80vh;">
			<div class="card-body p-4">
				<div class="d-flex justify-content-between">
					<div class="d-flex align-items-center">
						<h5 class="card-title h2">Pemesanan</h5>
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
							<th scope="col">Tanggal</th>
							<th scope="col">Status</th>
							<th scope="col">Total Harga</th>
							<th scope="col">Jumlah Service</th>
							<th scope="col">Services</th>
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
							<select class="form-select" aria-label="Status" name="Status">
								<option selected hidden value="">Select Status</option>
								<option value="Booked">Booked</option>
								<option value="Done">Done</option>
								<option value="Canceled">Canceled</option>
							</select>
						</div>
						<div class="mb-3">
							<select class="form-select" aria-label="Kamar" name="id_Service">
								<option selected hidden value="">Select Service</option>
							</select>
						</div>
						<div class="mb-3">
							<label for="Date" class="form-label">Tanggal</label>
							<input type="Date" class="form-control" id="Tgl_pemesanan" placeholder="input Date" name="Tgl_pemesanan">
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
							<select class="form-select" aria-label="Status" id="StatusUpdate" name="Status">
								<option selected hidden value="">Select Status</option>
								<option value="Booked">Booked</option>
								<option value="Done">Done</option>
								<option value="Canceled">Canceled</option>
							</select>
						</div>
						<div class="mb-3">
							<select class="form-select" aria-label="Kamar" id="id_ServiceUpdate" name="id_Service">
								<option selected hidden value="">Select Service</option>
							</select>
						</div>
						<div class="mb-3">
							<label for="Date" class="form-label">Tanggal</label>
							<input type="Date" class="form-control" id="Tgl_pemesananUpdate" placeholder="input Date" name="Tgl_pemesanan">
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
		axios.get(`/api/Pemesanan?page=${page}&per_page=${itemsPerPage}&search=${search}`, {
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
				data.data.forEach(Pemesanan => {
					const serviceCount = Pemesanan.service.length;
					const serviceTruncated = Pemesanan.service
						.slice(0, 2)
						.map(service => service.nama)
						.join(', ') + (Pemesanan.service.length > 2 ? '...' : '');
					const serviceFull = Pemesanan.service
						.map(service => `<li class="px-2">${service.nama}</li>`)
						.join('');
					const row = `
                        <tr class="mt-5 shadow">
                            <td>${Pemesanan.id_pemesanan}</td>
							<td>${Pemesanan.id_users}</td>
                            <td>${Pemesanan.Tgl_pemesanan}</td>
                            <td>${Pemesanan.Status}</td>
                            <td>${Pemesanan.total_harga}</td>
							<td>${serviceCount}</td>
							 <td>
							<div class="dropdown-center">
                    <a class="btn dropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        ${serviceTruncated}
                    </a>
                    <ul class="dropdown-menu">
                        <div class="d-flex flex-wrap">
                            ${serviceFull}
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
		axios.post('/api/Pemesanan/dashboard', formData, {
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
		fetch('/api/JenisService/all', {
				headers: {
					'Authorization': `Bearer ${token}`
				}
			})
			.then(response => response.json())
			.then(data => {
				const select = document.querySelector('select[name="id_Service"]');
				select.innerHTML = '<option selected hidden value="">Select Service</option>';
				data.data.forEach(item => {
					const option = document.createElement('option');
					option.value = item.id_service;
					option.textContent = item.id_service + " | " + item.nama;
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
	var idUser;
	document.getElementById('modalUpdate').addEventListener('shown.bs.modal', function() {
		fetch('/api/JenisService/all', {
				headers: {
					'Authorization': `Bearer ${token}`
				}
			})
			.then(response => response.json())
			.then(data => {
				const select = document.getElementById('id_ServiceUpdate');
				select.innerHTML = '<option selected hidden value="">Select Service</option>';
				data.data.forEach(item => {
					const option = document.createElement('option');
					option.value = item.id_service;
					option.textContent = item.id_service + " | " + item.nama;
					select.appendChild(option);
				});
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
			const date = row.querySelector('td:nth-child(3)').textContent.trim();
			const Status = row.querySelector('td:nth-child(4)').textContent.trim();
			const TotalHarga = row.querySelector('td:nth-child(5)').textContent.trim();
			document.getElementById('StatusUpdate').value = Status;
			document.getElementById('totalHargaUpdate').value = TotalHarga;
			document.getElementById('Tgl_pemesananUpdate').value = date;
			document.getElementById('DiskonUpdate').value = 10;
			document.getElementById('submitFormUpdate').dataset.id = id;
		}
	});

	document.getElementById('submitFormUpdate').addEventListener('submit', function(e) {
		const formData = new FormData(this);
		const id = this.dataset.id;
		console.log(formData);
		axios.post('/api/Pemesanan/dashboard/' + id, formData, {
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
		axios.delete(`/api/Pemesanan/${id}`, {
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