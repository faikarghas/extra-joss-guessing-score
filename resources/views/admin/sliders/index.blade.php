@extends('admin.layouts.dashboard')
@section('title')
  Sliders
@endsection
@section('breadcrumbs')
  {{ Breadcrumbs::render('sliders') }}
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
     <div class="card">
        <div class="card-header">
           <div class="row">
              <div class="col-md-6">
                 <form action="" method="GET" class="form-inline form-row">
                    <div class="col">
                       <div class="input-group mx-1">
                          <label class="font-weight-bold mr-2">Status</label>
                          <select name="status" class="custom-select">
                             <option value="publish" selected>Publish</option>
                             <option value="draft">Draft</option>
                          </select>
                          <div class="input-group-append">
                             <button class="btn btn-primary" type="submit">Apply</button>
                          </div>
                       </div>
                    </div>
                    <div class="col">
                       <div class="input-group mx-1">
                          <input name="keyword" type="search" class="form-control" placeholder="Search for posts">
                          <div class="input-group-append">
                             <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i>
                             </button>
                          </div>
                       </div>
                    </div>
                 </form>
              </div>
              <div class="col-md-6">
                 <a href="{{ route ('sliders.create') }}" class="btn btn-primary float-right" role="button">
                     <i class="fas fa-plus-square"></i>
                 </a>
              </div>
           </div>
        </div>
        <div class="card-body">
           <ul class="list-group list-group-flush">
              <!-- list post -->
              @forelse ($slider as $row )
                <div class="card">
                  <div class="card-body">
                    <h6>
                      {{ $row->title }}
                    </h6>
                    <p></p>
                    <div class="float-right">
                        <!-- list Content -->
                        <a href ="{{ route('posts.details',1) }}" class="btn btn-sm btn-success" role="button">
                           <i class="fas fa-file"></i>
                        </a>
                        {{-- <a href ="{{ route('post.show',['slider'=>$row]) }}" class="btn btn-sm btn-success disabled" role="button">
                           <i class="fas fa-file"></i>
                        </a> --}}
                        <!-- edit -->
                        <a href ="{{ route('sliders.edit',['slider'=>$row]) }}" class="btn btn-sm btn-info" role="button">
                          <i class="fas fa-edit"></i>
                        </a>
                        <!-- delete -->
                        <form class="d-inline" action="{{ route('sliders.destroy',['slider'=>$row]) }}" role="alert" method="POST" alert-text="{{ $row->title }}">
                           @csrf
                           @method('DELETE')
                          <button type="submit" class="btn btn-sm btn-danger">
                              <i class="fas fa-trash"></i>
                          </button>
                        </form>
                    </div>
                  </div>
              </div>
              @empty
                <p> Data Banner Belum Ada </p>
              @endforelse
           </ul>
        </div>
     </div>
  </div>
</div>
@endsection 
@push('javascript-internal')
   <script>
      $(document).ready(function(){
         // event delete category
         $("form[role='alert']").submit(function(event){
            event.preventDefault(); 
            Swal.fire({
               title: "Apakah anda ingin menghapus ?",
               text: $(this).attr('alert-text'),
               icon: 'warning',
               allowOutsideClick: false,
               showCancelButton: true,
               cancelButtonText: "Cancel",
               reverseButtons: true,
               confirmButtonText: "Yes",
            }).then((result) => {
               if (result.isConfirmed) {
                  // todo: process of deleting categories
                  event.target.submit(); 
               }
            });
         });
      });
   </script>
@endpush