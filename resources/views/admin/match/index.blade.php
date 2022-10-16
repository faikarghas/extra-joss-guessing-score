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
   <h5 class="card-header">List Matchs</h5>
   <div class="table-responsive text-nowrap">
     <table class="table">
       <thead>
         <tr>
           <th>Team A</th>
           <th>Team B</th>
           <th>Result</th>
           <th>Round</th>
           <th>Status</th>
           <th>Match Time</th>
           <th>Actions</th>
         </tr>
       </thead>
       <tbody class="table-border-bottom-0">
         @foreach ($datas as $row)
            <tr>
               <td><strong>{{ $row->id_team_a }}</strong></td>
               <td><strong>{{ $row->id_team_b }}</strong></td>
               <td>{{ $row->score_a }} - {{ $row->score_b }}</td>
               <td><span class="badge bg-label-success me-1">Quilefied</span></td>
               <td><span class="badge bg-label-warning me-1">Ongoing</span></td>
               <td><span class="badge bg-label-success me-1">22:00 WIB</span></td>
               <td>
                  <div class="dropdown">
                     <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                       <i class="bx bx-dots-vertical-rounded"></i>
                     </button>
                     <div class="dropdown-menu">
                       <a class="dropdown-item" href="javascript:void(0);"
                         ><i class="bx bx-edit-alt me-1"></i> Edit</a
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