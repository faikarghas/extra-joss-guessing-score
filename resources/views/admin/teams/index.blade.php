@extends('admin.layouts.dashboard')
@section('title')
    @php  
        $postId = last(request()->segments());
    @endphp
@endsection
@section('breadcrumbs')
{{ Breadcrumbs::render('posts') }}
@endsection
@section('content')

<!-- Basic Bootstrap Table -->
<div class="card">
   <h5 class="card-header">List Teams</h5>
   <div class="table-responsive text-nowrap">
     <table class="table">
       <thead>
         <tr>
           <th>Country</th>
           <th>Group</th>
           <th>Flag</th>
           <th>Status</th>
           <th>Actions</th>
         </tr>
       </thead>
       <tbody class="table-border-bottom-0">
         @foreach ($datas as $row)
            <tr>
               <td><strong>{{ $row->name }}</strong></td>
               <td>{{ $row->group }}</td>
               <td><img src="{{ $row->flag_image_path }}" width="35"></td>
               <td><span class="badge bg-label-success me-1">Quilefied</span></td>
               <td>
                  <div class="dropdown">
                     <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                       <i class="bx bx-dots-vertical-rounded"></i>
                     </button>
                     <div class="dropdown-menu">
                       <a class="dropdown-item" href="{{ route('teams.edit',[$row->id]) }}"
                         ><i class="bx bx-edit-alt me-1"></i> Edit</a
                       >
                       <a class="dropdown-item" href="{{ route('teams.show',[$row->id]) }}"
                         ><i class="bx bx-video-recording me-1"></i> View Matchs</a
                       >
                     </div>
                   </div>
               </td>
            </tr>
         @endforeach
       </tbody>
     </table>
   </div>
 </div>
 <!--/ Basic Bootstrap Table -->
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