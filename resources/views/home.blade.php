@extends('layout.app.app')
@section('title', 'Trang chủ')
@section('content')
<div id="carouselExampleAutoplaying" class="carousel slide pointer-event container-fluid w-80" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="bd-placeholder-img img-fluid d-block w-50 h-50 " src="{{ asset('images/banner-01.jpg') }}" alt="First slide" />
    </div>
    <div class="carousel-item">
      <img class="bd-placeholder-img img-fluid d-block w-50 " src="{{ asset('images/banner-02.jpg') }}" alt="Second slide" />
    </div>
    <div class="carousel-item">
      <img class="bd-placeholder-img img-fluid d-block w-50" src="{{ asset('images/banner-03.jpg') }}" alt="Third slide" />
    </div>
  </div>
  <button class="carousel-control-prev bg-opacity-50 border-0" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" ></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next bg-opacity-50 border-0" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" ></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<div class="container mt-4">
  <div class="row">
    @for ($i = 0; $i < 10; $i++)
    <div class="col-md-3 mb-4" v-for="product in products">
      <a href="{{ route('admin.auth.dashboard') }}" class="text-decoration-none text-dark">
        <div class="card h-100 card-hover">
          <img src="{{ asset('images/avatar-01.jpg') }}" class="card-img-top" alt="Sản phẩm">
          <!-- Nút overlay trong suốt -->
          <div class="overlay-button">
            <div class="btn btn-transparent">
              <i class="	bi bi-eye fs-1"></i> <!-- Icon kính lúp -->
            </div>
          </div>
      
          <div class="card-body">
            <h5 class="card-title">Tên Sản Phẩm</h5>
            <p class="card-text">Giá: <strong>500.000 VND</strong></p>
          </div>
        </div>
      </a>     
    </div>
  @endfor

  </div>
</div>

@endsection