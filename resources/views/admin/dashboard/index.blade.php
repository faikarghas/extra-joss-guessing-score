@extends('admin.layouts.dashboard')
@section('title')
  Dashboard  
@endsection
@section('breadcrumbs')
  {{-- {{ Breadcrumbs::render('dashboard') }} --}}
@endsection
@section('content')
  <div class="row">
    <div class="col-lg-8 mb-4 order-0">
      <div class="card">
        <div class="d-flex align-items-end row">
          <div class="col-sm-7">
            <div class="card-body">
              <h5 class="card-title text-primary">Selamat Datang {{ Auth::user()->name }}</h5>
              <p class="mb-4">
                Hari ini ada  <span class="fw-bold">{{$userNeedUpdateForGuess}} Score</span> yang belum di Update. Klik Update Score Di bawah ini 
              </p>
              <p class="btn btn-sm btn-outline-primary updateSkor">Update Score</p>
            </div>
          </div>
          <div class="col-sm-5 text-center text-sm-left">
            <div class="card-body pb-0 px-0 px-md-4">
              <img
                src="{{ asset('vendor/my-dashboard/img/illustrations/man-with-laptop-light.png') }}"
                height="140"
                alt="View Badge User"
                data-app-dark-img="illustrations/man-with-laptop-dark.png"
                data-app-light-img="illustrations/man-with-laptop-light.png"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 order-1">
      <div class="row">
        <div class="col-lg-6 col-md-12 col-6 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <i class='bx bx-user bx-lg '></i>
                </div>
              </div>
              <span class="fw-semibold d-block mb-1">User Register</span>
              <h3 class="card-title mb-2">12,628</h3>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-12 col-6 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <i class='bx bx-user bx-lg '></i>
                </div>
              </div>
              <span class="fw-semibold d-block mb-1">User Online</span>
              <h3 class="card-title text-nowrap mb-1">4,679</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection 