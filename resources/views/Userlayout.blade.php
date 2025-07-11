@extends('Layout')


@section('content')
<div class="overflow-x-hidden">
	<div class="bg-black " style="width: 100vw; height:8vh;"></div>
	<div class="vh-100 bg-white mt-5 container-fluid mx-5">
		<div class="row">
			<div class="col-2 ">
				<div>
					<div class="card" style="width: 20rem;">
						<div class="card-body px-5 py-3">
							<a href="{{url('Profile')}}" class=" w-100 shadow mt-2 px-5  py-2 btn  {{ (request()->is('Profile')) ? 'btn-info text-white border-white' : '  border-info text-black' }}">
								Profile
							</a>
							<a href="{{url('Orders')}}" class=" w-100 shadow mt-2 px-5  py-2 btn  {{ (request()->is('Orders')) ? 'btn-info text-white border-white' : '  border-info text-black' }}">
								Your Orders
							</a>
						</div>
					</div>
					<div class="card  mt-5" style="width: 20rem;">
						<div class="card-body px-5 py-3">
							<a href="{{url('Setting')}}" class=" w-100 shadow mt-2 px-5  py-2 btn  {{ (request()->is('Setting')) ? 'btn-info text-white border-white' : '  border-info text-black' }}">
								Setting
							</a>
							<a href="{{url('Help')}}" class=" w-100 shadow mt-2 px-5  py-2 btn  {{ (request()->is('Help')) ? 'btn-info text-white border-white' : '  border-info text-black' }}">
								Help Center
							</a>
						</div>
					</div>
					<div class="card mt-5" style="width: 20rem;">
						<div class="card-body px-5 py-3">
							<a href="javascript:void(0)"
								onclick="logout()"
								class="w-100 shadow mt-2 px-5 py-2 btn {{ (request()->is('Logout')) ? 'btn-info text-white border-white' : 'border-info text-black' }}">
								Log Out
							</a>
							<p><i class="fa-solid fa-circle-exclamation me-3 mt-5"></i>Norem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec </p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-10">
				@yield('contentUser')
			</div>
		</div>
	</div>
</div>
<script>
	function logout() {
		const token = localStorage.getItem('token');
		if (token) {
			axios.post('/api/logout', {}, {
					headers: {
						'Authorization': `Bearer ${token}`
					}
				})
				.then(() => {
					localStorage.removeItem('token');
					window.location.href = '/Login';
				})
				.catch(error => {
					console.error('Error during logout:', error);

					localStorage.removeItem('token');
					window.location.href = '/Login';
				});
		} else {
			window.location.href = '/Login';
		}
	}
</script>
@endsection