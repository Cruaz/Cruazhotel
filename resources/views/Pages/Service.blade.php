@extends('Layout')

@section('title', 'Service')

@section('content')

<div class="">
    <div class="position-relative">
        <img src="{{asset('images/Service-1.jpg')}}" alt="" class=" object-fit-cover d-none d-lg-block img-fluid " style="width: 100%; height: 70vh; filter: brightness(50%)">
        <div class="container position-absolute top-50 start-50 translate-middle text-white text-center">
            <h2 class="display-4 fw-bold">Services and Facilities</h2>
            <p class="mt-2">Find your needs around and in the hotel</p>
        </div>
        <div class="d-none d-md-flex  container mx-auto bg-white position-absolute z-3 rounded row g-3 align-items-center justify-content-center px-5 shadow" style="   position: absolute; right: 0;bottom: -5rem; height:10rem ;left: 0; ">
            <div class="col-md-10 mt-0">
                <label for="inputEmail4" class="form-label">Select Date</label>
                <input type="date" class="form-control" id="inputEmail4">
            </div>
            <div class="col-md-2 mt-0">
                <a href="{{url('Reserve')}}">
                    <button type="button" class="mt-2 px-5 text-white py-2 btn btn-info">Reserve</button>
                </a>
            </div>
        </div>

        <div class="d-block d-md-none">
            <a href="{{url('Reserve')}}">
                <button type="button" class="mt-2 px-5 text-white py-2 btn btn-info">Reserve</button>
            </a>
        </div>
    </div>
    <div class="container mb-5 text-center" style="margin-top:10rem;">
        <h2 class="display-6 fw-semibold mb-3">CruazHotel’s Services And Facilities</h2>
        <div class="divider mx-auto"></div>
        <p class="mt-3 fs-6 w-50 mx-auto">Norem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus,</p>
    </div>
    <div class="container" style="margin-top: 5rem;" id="Fasilitas">
    </div>
    <div class="container mb-5 text-center" style="margin-top:5.5rem;">
        <h2 class="display-6 fw-semibold mb-3">Room Services</h2>
        <div class="divider mx-auto"></div>
        <p class="mt-3 fs-6 w-50 mx-auto">Norem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus,</p>
    </div>
    <div class="container mb-5">
        <div class="row gy-5 gy-lg-0 gx-xl-5 align-items-center" id="InRoom">
        </div>
    </div>
    <div class="d-flex overflow-x-hidden" style="margin-top: 10rem;">
        <img src="{{asset('images/Service-2.jpg')}}" class="card-img-top img-fluid" alt="..." style="width: 380px; height: 250px; object-fit: cover;">
        <img src="{{asset('images/Service-3.jpg')}}" class="card-img-top img-fluid" alt="..." style="width: 380px; height: 250px; object-fit: cover;">
        <img src="{{asset('images/Service-4.jpg')}}" class="card-img-top img-fluid" alt="..." style="width: 380px; height: 250px; object-fit: cover;">
        <img src="{{asset('images/Service-5.jpg')}}" class="card-img-top img-fluid" alt="..." style="width: 380px; height: 250px; object-fit: cover;">
        <img src="{{asset('images/Service-6.jpg')}}" class="card-img-top img-fluid" alt="..." style="width: 380px; height: 250px; object-fit: cover;">
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    axios.get('/api/JenisService/all')
        .then(response => {
            const data = response.data.data;
            console.log(data);
            const fasilitasContainer = document.querySelector('#Fasilitas');
            const inRoomContainer = document.querySelector('#InRoom');

            let fasilitasHTML = '';
            let inRoomHTML = '';
            var count = 1;
            var count2 = 1;
            data.forEach(service => {
                if (service.tipe === 1) {
                    console.log(service.galery.length);
                    // Ensure firstImage is assigned properly
                    const firstImage = service.galery.length > 0 ?
                        '/storage/Galery/' + service.galery[0].foto :
                        '/images/Service-all.jpg';
                    const isEven = count % 2 === 0;
                    fasilitasHTML += `
                    <div class="row align-items-center">
                        ${isEven
                            ? `<div class="col-12 col-md-6 text-md-end">
                                    <h2 class="display-5 fw-bold">${service.nama}</h2>
                                    <p class="mt-2 fs-6">${service.deskripsi}</p>
                                    <a href="/DetailService?ServiceId=${service.id_service}" class="btn">
                                        <i class="fa-solid fa-chevron-left me-3"></i> Learn More
                                    </a>
                                </div>
                                <div class="d-none d-md-block col-md-6">
                                    <div class="container-image2 mx-auto">
                                        <img src="${firstImage}" alt="" class="w-100 h-100 object-fit-cover d-block img-fluid">
                                        <div class="position-absolute top-50 start-0 translate-middle text-center px-5 py-3 text-white rounded bg-us">
                                            IDR ${Number(service.harga).toLocaleString('id-ID')}
                                        </div>
                                    </div>
                                </div>`
                            : `<div class="d-none d-md-block col-md-6">
                                    <div class="container-image2 mx-auto">
                                        <img src="${firstImage}" alt="" class="w-100 h-100 object-fit-cover d-block img-fluid">
                                        <div class="position-absolute top-50 start-100 translate-middle text-center px-5 py-3 text-white rounded bg-us">
                                            IDR ${Number(service.harga).toLocaleString('id-ID')}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <h2 class="display-5 fw-bold">${service.nama}</h2>
                                    <p class="mt-2 fs-6">${service.deskripsi}</p>
                                    <a href="/DetailService?ServiceId=${service.id_service}" class="btn">
                                        Learn More <i class="fa-solid fa-chevron-right ms-3"></i>
                                    </a>
                                </div>`}
                    </div>`;

                    count++;
                } else if (service.tipe === 0) {
                    const isEven = count2 % 2 === 0;
                    inRoomHTML += `
                    <div class="col-3">
                        <div class="card text-center ${isEven ? 'bg-us text-white' : ''}">
                            <div class="card-body">
                                <h2 class="display-4 mb-2 text-center mt-5">
                                    <i class="fa-solid ${service.namaIcon}"></i>
                                </h2>
                                <h5 class="card-title">${service.nama}</h5>
                                <h6 class="card-subtitle mb-5">IDR ${Number(service.harga).toLocaleString('id-ID')}</h6>
                                <a href="/DetailService?ServiceId=${service.id_service}" class="card-subtitle">Learn More</a>
                            </div>
                        </div>
                    </div>`;
                    count2++;
                }
            });

            fasilitasContainer.innerHTML = fasilitasHTML;
            inRoomContainer.innerHTML = inRoomHTML;
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
</script>
@endsection