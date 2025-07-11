@extends('Userlayout')

@section('title', 'Setting')

@section('contentUser')

<div class="container">
	<div class="col-12">
		<div class="card mb-3 w-100 p-5">
			<form id="updateForm" class="mt-2 mx-5" enctype="multipart/form-data"  autocomplete="off">
				<div class="mb-3">
					<label for="username" class="form-label fw-bold fs-5">Username</label>
					<input type="text" class="form-control p-3 border-info rounded-3 shadow" id="username" name="name" placeholder="Input Your Username....."  autocomplete="off" >
				</div>
				<div class="mb-3">
					<label for="phoneNumber" class="form-label fw-bold fs-5">Phone Number</label>
					<input type="text" class="form-control p-3 border-info rounded-3 shadow" id="phoneNumber" name="noTelp" placeholder="Input Your Phone Number.....">
				</div>
				<div class="mb-3">
					<label for="email" class="form-label fw-bold fs-5">Email</label>
					<input type="email" class="form-control p-3 border-info rounded-3 shadow" id="email" name="email" placeholder="Input Your Email.....">
				</div>
				<div class="mb-3">
					<label for="password" class="form-label fw-bold fs-5">Password</label>
					<input type="password" class="form-control p-3 border-info rounded-3 shadow" id="password" name="password" placeholder="Input Your Password....."  autocomplete="new-password" >
				</div>
				<div class="mb-3">
					<label for="foto" class="form-label fw-bold fs-5">Foto</label>
					<input class="form-control p-3 border-info rounded-3 shadow" type="file" id="foto" name="foto">
				</div>
				<button type="submit" class="btn btn-info text-white py-2 px-5 mt-4">Save</button>
			</form>

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
		
			document.getElementById('username').value = data.name;
			document.getElementById('phoneNumber').value = data.noTelp;
			document.getElementById('email').value = data.email;
			document.getElementById('password').value = "";
		})
		.catch(error => {
			console.error('Error fetching data:', error);
		});
	};
	UserData();
	document.getElementById('updateForm').addEventListener('submit', function(e) {
		const formData = new FormData(this);
		fetch(`/api/UserEditData`, {
				method: 'POST',
				body: formData,
				headers: {
					'Authorization': `Bearer ${token}`
				}
			})
			.then(response => response.json())
			.then(data => {
				if (data.message === 'user Updated Successfully') {
					console.log('User updated successfully');
				} else {
					console.log('Error: ' + data.message);
				}
			})
			.catch(error => {
				console.error('Error updating user:', error);
			});
	});
</script>
@endsection