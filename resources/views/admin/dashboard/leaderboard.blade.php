@extends('admin.layouts.dashboard')
@section('title')
  Dashboard  
@endsection
@section('breadcrumbs')
  {{-- {{ Breadcrumbs::render('dashboard') }} --}}
@endsection
@section('content')
  <div class="row">
    <div class="col-md-12 order-3">
      <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Point 1</th>
                <th>Point 2</th>
                <th>Point 3</th>
                <th>Point 4</th>
                <th>Total Point</th>
            </tr>
        </thead>
        <tbody>
            @foreach($klasemens as $key => $user)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->point_1 }}</td>
                    <td>{{ $user->point_2 }}</td>
                    <td>{{ $user->point_3 }}</td>
                    <td>{{ $user->point_4 }}</td>
                    <td>{{ $user->total_point }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
  </div>
@endsection 