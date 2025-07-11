@extends('Userlayout')

@section('title', 'Orders')

@section('contentUser')
<div class="container">
	<div class="col-12">
		<div class="card mb-3 w-100 px-5 py-3">
			<div class="d-flex justify-content-between mb-4">
				<div class="d-flex align-items-center">
					<h5 class="card-title h2">Your Orders</h5>
					<div class="dropdown ms-3">
						<button class="btn btn-outline-info text-black dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
							10
						</button>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item " href="#">5</a></li>
							<li><a class="dropdown-item active" href="#">10</a></li>
							<li><a class="dropdown-item" href="#">20</a></li>
						</ul>
					</div>
				</div>
				<a href="">
					<button type="button" class="px-4 text-white py-2 btn btn-info"><i class="fa-solid fa-filter me-3"></i>Filter</button>
				</a>
			</div>
			<div id="card-container">
			</div>

			<nav aria-label="Page" class="mt-5">
				<ul class="pagination justify-content-end" id="pagination-container">
				</ul>
			</nav>
		</div>
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
	async function fetchData(page = 1) {
		try {
			const response = await axios.get(`/api/User/BookingPesanan?page=${page}`, {
				headers: {
					Authorization: `Bearer ${localStorage.getItem('token')}`
				}
			});
			const {
				data
			} = response.data;
			renderCards(data.data);
			renderPagination(data.links); 

		} catch (error) {
			console.error('Error fetching data:', error);
			alert('Failed to fetch data!');
		}
	}
	function renderCards(items) {
		const cardContainer = document.getElementById('card-container');
		cardContainer.innerHTML = ''; 

		items.forEach(item => {
			let options = '';
			if (item.type === 'Booking' && item.kamar) {
				options = item.kamar.map(kamar => `
                <p class="card-text mb-0 mt-2 me-4">
                    <i class="fa-solid fa-door-open me-3"></i> 
                    Room ${kamar.id_kamar} - Floor ${kamar.lantai} (${kamar.Status})
                </p>
            `).join('');
			}
			if (item.type === 'Pesanan' && item.service) {
				options = item.service.map(service => `
                <p class="card-text mb-0 mt-2 me-4">
                    <i class="fa-solid fa-bell-concierge me-3"></i> 
                    ${service.nama} - IDR ${service.harga}
                </p>
            `).join('');
			}
			const image = item.type === 'Booking' ? 'Room-4.png' : 'Service-2.jpg';
			const card = `
            <div class="card mb-3 w-100">
                <div class="row g-0">
                    <div class="col-md-2">
                        <img src="{{asset('images/${image}')}}" class="img-fluid rounded-start" style="height:100%; object-fit: cover; " alt="...">
                    </div>
                    <div class="col-md-10">
                        <div class="card-body w-100 px-5">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="card-text mb-0"><small class="text-body-secondary">${item.type} -</small> ${item.Status}</p>
                                    <h5 class="h1 card-title mb-0">${item.type === 'Booking' ? item.CheckIn +" - "+ item.CheckOut : item.Tgl_pemesanan}</h5>
                                </div>
                                
                            </div>
                            <p class="card-text">IDR ${item.total_harga} ${item.type === 'Pesanan' ? '/ Jam' : '/ Malam'}</p>
                            <div class="d-flex flex-wrap" style="width: 50%;">
                                ${options}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
			cardContainer.innerHTML += card;
		});
	}
	function renderPagination(links) {
		const paginationContainer = document.getElementById('pagination-container');
		paginationContainer.innerHTML = '';
		links.forEach(link => {
			if (link.url) {
				paginationContainer.innerHTML += `
                    <li class="page-item ${link.active ? 'active' : ''}">
                        <a class="page-link" href="#" onclick="fetchData(${getPageFromUrl(link.url)})">${link.label}</a>
                    </li>`;
			}
		});
	}
	function getPageFromUrl(url) {
		const params = new URL(url).searchParams;
		return params.get('page') || 1;
	}

	fetchData();
</script>
@endsection