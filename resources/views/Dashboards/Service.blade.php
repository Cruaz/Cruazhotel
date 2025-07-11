@extends('AdminLayout')

@section('title', 'Service')

@section('content')

<div class="">
	<div class="container-fluid">

		<div class="card" style="height:80vh;">
			<div class="card-body p-4">
				<div class="d-flex justify-content-between">
					<div class="d-flex align-items-center">
						<h5 class="card-title h2">Service</h5>
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
							<th scope="col">nama</th>
							<th scope="col">Nama Icon</th>
							<th scope="col">harga</th>
							<th scope="col">Tipe</th>
							<th scope="col">Deskripsi</th>
							<th scope="col">Service Overview</th>
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
					@csrf
					<div class="modal-body">
						<div class="mb-3">
							<label for="Username" class="form-label">Nama Service</label>
							<input type="text" class="form-control" id="NamaService" placeholder="input NamaService" name="nama">
						</div>
						<div class="mb-3">
							<label for="Harga" class="form-label">Harga</label>
							<input type="number" class="form-control" id="Harga" placeholder="input Harga" name="harga">
						</div>
						<div class="mb-3">
							<select class="form-select" aria-label="Service" name="tipe">
								<option selected hidden>Select Tipe</option>
								<option value="0">In-Room</option>
								<option value="1">Fasilitas</option>
							</select>
						</div>
						<div class="mb-3">
							<label for="icon" class="form-label">Nama Icon</label>
							<input type="text" class="form-control" id="icon" placeholder="input Nama Icon" name="namaIcon">
						</div>
						<div class="mb-3">
							<div class="form-floating">
								<textarea class="form-control" placeholder="Leave a Deskripsi" id="Deskripsi" name="deskripsi"></textarea>
								<label for="Deskripsi">Deskripsi</label>
							</div>
						</div>
						<div class="mb-3">
							<div class="form-floating">
								<textarea class="form-control" placeholder="Leave a ServiceOverview" id="ServiceOverview" name="ServiceOverview"></textarea>
								<label for="ServiceOverview">Service Overview</label>
							</div>
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
					@csrf
					<div class="modal-body">
						<div class="mb-3">
							<label for="Username" class="form-label">Nama Service</label>
							<input type="text" class="form-control" id="NamaServiceUpdate" placeholder="input NamaService" name="nama">
						</div>
						<div class="mb-3">
							<label for="Harga" class="form-label">Harga</label>
							<input type="number" class="form-control" id="HargaUpdate" placeholder="input Harga" name="harga">
						</div>
						<div class="mb-3">
							<select class="form-select" aria-label="Service" id="tipeUpdate" name="tipe">
								<option selected hidden>Select Tipe</option>
								<option value="0">In-Room</option>
								<option value="1">Fasilitas</option>
							</select>
						</div>
						<div class="mb-3">
							<label for="icon" class="form-label">Nama Icon</label>
							<input type="text" class="form-control" id="iconUpdate" placeholder="input Nama Icon" name="namaIcon">
						</div>
						<div class="mb-3">
							<div class="form-floating">
								<textarea class="form-control" placeholder="Leave a Deskripsi" id="DeskripsiUpdate" name="deskripsi"></textarea>
								<label for="Deskripsi">Deskripsi</label>
							</div>
						</div>
						<div class="mb-3">
							<div class="form-floating">
								<textarea class="form-control" placeholder="Leave a ServiceOverview" id="ServiceOverviewUpdate" name="ServiceOverview"></textarea>
								<label for="ServiceOverview">Service Overview</label>
							</div>
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
					<h1 class="modal-title fs-5" id="modalDeleteLabel">Update Data</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="" id="submitFormDelete">
					<div class="modal-body">
						<input type="hidden" class="form-control" id="idDelete" value="" name="id_fasilitas">
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
	function changeItemsPerPage(newPerPage) {
		perPage = newPerPage;
		document.getElementById('items-per-page-btn').innerText = newPerPage;
		fetchData(1, perPage);
	}

	function truncate(text, maxLength) {
		return text.length > maxLength ? text.substring(0, maxLength) + "..." : text;
	}

	function fetchData(page = 1, itemsPerPage = perPage) {
		const search = document.getElementById('search').value;
		axios.get(`/api/JenisService?page=${page}&per_page=${itemsPerPage}&search=${search}`, {
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
				data.data.forEach(JenisService => {
					const row = `
                        <tr class="mt-5 shadow">
                           	<td>${JenisService.id_service}</td>
                            <td>${JenisService.nama}</td>
                            <td>${JenisService.namaIcon}</td>
                            <td>${JenisService.harga}</td>
                            <td>${JenisService.tipe}</td>
                            <td>
								<div class="dropdown-center">
									<a class="btn dropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
										${truncate(JenisService.deskripsi, 10)}
									</a>
									<ul class="dropdown-menu">
										<div class="d-flex flex-wrap">
											<li class="px-2">${JenisService.deskripsi}</li>
										</div>
									</ul>
								</div>
							
							</td>
                            <td>
								<div class="dropdown-center">
									<a class="btn dropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
										${truncate(JenisService.ServiceOverview, 10)}
									</a>
									<ul class="dropdown-menu">
										<div class="d-flex flex-wrap">
											<li class="px-2">${JenisService.ServiceOverview}</li>
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
		axios.post('/api/JenisService', formData, {
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
		if (event.target && event.target.classList.contains('update-btn')) {
			const button = event.target;
			const row = button.closest('tr');
			const id = row.querySelector('td:nth-child(1)').textContent.trim();
			const nama = row.querySelector('td:nth-child(2)').textContent.trim();
			const namaIcon = row.querySelector('td:nth-child(3)').textContent.trim();
			const harga = row.querySelector('td:nth-child(4)').textContent.trim();
			const tipe = row.querySelector('td:nth-child(5)').textContent.trim();
			const deskripsi = row.querySelector('td:nth-child(6) .dropdown-menu .px-2').textContent.trim();
			const ServiceOverview = row.querySelector('td:nth-child(7) .dropdown-menu .px-2').textContent.trim();
			document.getElementById('NamaServiceUpdate').value = nama;
			document.getElementById('iconUpdate').value = namaIcon;
			document.getElementById('tipeUpdate').value = tipe;
			document.getElementById('HargaUpdate').value = harga;
			document.getElementById('ServiceOverviewUpdate').value = ServiceOverview;
			document.getElementById('DeskripsiUpdate').value = deskripsi;
			document.getElementById('submitFormUpdate').dataset.id = id;
		}
	});

	document.getElementById('submitFormUpdate').addEventListener('submit', function(e) {
		const formData = new FormData(this);
		const id = this.dataset.id;
		console.log(formData);
		axios.post('/api/JenisService/' + id, formData, {
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
			document.getElementById('showdelete').textContent = id;
			document.getElementById('idDelete').value = id;
			document.getElementById('submitFormDelete').dataset.id = id;
		}
	});

	document.getElementById('submitFormDelete').addEventListener('submit', function(e) {
		const formData = new FormData(this);
		const id = this.dataset.id;
		console.log(formData);
		axios.delete(`/api/JenisService/${id}`, {
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