@extends('AdminLayout')

@section('title', 'Kamar')

@section('content')

<div class="">
	<div class="container-fluid">
		<div class="card" style="height:80vh;">
			<div class="card-body p-4">
				<div class="d-flex justify-content-between">
					<div class="d-flex align-items-center">
						<h5 class="card-title h2">Kamar</h5>
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

				<!-- Table -->
				<table class="table w-100 text-center">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Lantai</th>
							<th scope="col">Status</th>
							<th scope="col">Jenis</th>
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
							<select class="form-select" aria-label="Kamar" name="id_jenises">
								<option selected hidden value=""> Select Kamar</option>
								<!-- <option value="JK002">JK002</option>
								<option value="JK002">JK002</option>
								<option value="JK002">JK002</option> -->
							</select>
						</div>
						<div class="mb-3">
							<select class="form-select" aria-label="Kamar" name="Status">
								<option selected hidden>Select Status</option>
								<option value="Booked">Booked</option>
								<option value="Available">Available</option>
								<option value="Maintenence">Maintenence</option>
							</select>
						</div>
						<div class="mb-3">
							<label for="text" class="form-label">Lantai</label>
							<input type="text" class="form-control" id="Lantai" placeholder="input Lantai" name="lantai">
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
				<form id="submitFormUpdate">
					@csrf
					<div class="modal-body">
						<div class="mb-3">
							<select class="form-select" aria-label="Kamar" name="id_jenises" id="id_jenisesUpdate">
								<option hidden>Select Kamar</option>
								<!-- Options will be populated dynamically -->
							</select>
						</div>
						<div class="mb-3">
							<select class="form-select" name="Status" id="statusUpdate">
								<option selected hidden>Select Status</option>
								<option value="Booked">Booked</option>
								<option value="Available">Available</option>
								<option value="Maintenence">Maintenence</option>
							</select>
						</div>
						<div class="mb-3">
							<label for="Lantai" class="form-label">Lantai</label>
							<input type="text" class="form-control" id="LantaiUpdate" name="lantai" placeholder="Input Lantai">
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
	function changeItemsPerPage(newPerPage) {
		perPage = newPerPage;
		document.getElementById('items-per-page-btn').innerText = newPerPage;
		fetchData(1, perPage);
	}

	function fetchData(page = 1, itemsPerPage = perPage) {
		const search = document.getElementById('search').value;
		axios.get(`/api/Kamar?page=${page}&per_page=${itemsPerPage}&search=${search}`, {
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
				data.data.forEach(kamar => {
					const row = `
                        <tr class="mt-5 shadow">
                            <td>${kamar.id_kamar}</td>
                            <td>${kamar.lantai}</td>
                            <td>${kamar.Status}</td>
                            <td>${kamar.id_jenises}</td>
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
		axios.post('/api/Kamar', formData, {
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
		fetch('/api/JenisKamar/all', {
				headers: {
					'Authorization': `Bearer ${token}`
				}
			})
			.then(response => response.json())
			.then(data => {
				const select = document.querySelector('select[name="id_jenises"]');
				select.innerHTML = '<option selected hidden value="">Select Kamar</option>';
				data.data.forEach(item => {
					const option = document.createElement('option');
					option.value = item.id_jenis;
					option.textContent = item.id_jenis + " | " + item.nama;
					select.appendChild(option);
				});
			})
			.catch(error => {
				console.error('Error fetching jenis data:', error);
			});
	});
	var idJenis;
	document.getElementById('modalUpdate').addEventListener('shown.bs.modal', function() {
		fetch('/api/JenisKamar/all', {
				headers: {
					'Authorization': `Bearer ${token}`
				}
			})
			.then(response => response.json())
			.then(data => {
				const select = document.getElementById('id_jenisesUpdate');
				select.innerHTML = '<option selected hidden value="">Select Kamar</option>';
				data.data.forEach(item => {
					const option = document.createElement('option');
					option.value = item.id_jenis;
					option.textContent = item.id_jenis + " | " + item.nama;
					select.appendChild(option);
				});
				const options = Array.from(select.options);
				const selectedOption = options.find(option => option.value === idJenis);
				if (selectedOption) {
					select.value = idJenis;
				}
			})
			.catch(error => console.error('Error fetching jenis data:', error));
	});

	document.querySelector('tbody').addEventListener('click', function(event) {
		if (event.target && event.target.classList.contains('update-btn')) {
			const button = event.target;
			const row = button.closest('tr');
			const id = row.querySelector('td:nth-child(1)').textContent.trim();
			const lantai = row.querySelector('td:nth-child(2)').textContent.trim();
			const status = row.querySelector('td:nth-child(3)').textContent.trim();
			idJenis = row.querySelector('td:nth-child(4)').textContent.trim();
			document.getElementById('LantaiUpdate').value = lantai;
			document.getElementById('statusUpdate').value = status;
			document.getElementById('submitFormUpdate').dataset.id = id;
		}
	});

	document.getElementById('submitFormUpdate').addEventListener('submit', function(e) {
		const formData = new FormData(this);
		const id = this.dataset.id;
		console.log(formData);
		axios.post('/api/Kamar/' + id, formData, {
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
		axios.delete(`/api/Kamar/${id}`, {
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