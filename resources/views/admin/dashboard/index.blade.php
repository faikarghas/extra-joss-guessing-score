@extends('admin.layouts.dashboard')
@section('title')
  Dashboard  
@endsection
@section('breadcrumbs')
  {{-- {{ Breadcrumbs::render('dashboard') }} --}}
@endsection
@section('content')
  <div class="row">
      <div class="col-md-12">
        {{-- Selamat Datang {{ Auth::user()->name }} --}}
      </div>
  </div>
@endsection 