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
   <h5 class="card-header">List Posts</h5>
   <div class="table-responsive text-nowrap">
     <table class="table">
       <thead>
         <tr>
           <th>Title</th>
           <th>Category</th>
           <th>Status</th>
           <th>Actions</th>
         </tr>
       </thead>
       <tbody class="table-border-bottom-0">
         <tr>
            <td><strong>Angular Project</strong></td>
            <td>Angular Project</td>
           <td><span class="badge bg-label-primary me-1">Active</td>
           <td>
            <button type="button" class="btn btn-icon btn-info">
               <span class="tf-icons bx bx-edit-alt"></span>
             </button>
             <button type="button" class="btn btn-icon btn-danger">
               <span class="tf-icons bx bx-trash"></span>
             </button>
           </td>
         </tr>
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