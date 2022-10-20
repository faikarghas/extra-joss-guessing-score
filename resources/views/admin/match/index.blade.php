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
           <th>Match Status</th>
           <th>Match Time</th>
           <th>Status</th>
           <th>Actions</th>
         </tr>
       </thead>
       <tbody class="table-border-bottom-0">
         @foreach ($datas as $row)
            <tr>
               <td><strong>{{ $row->countries_one->name }}</strong></td>
               <td><strong>{{ $row->countries_two->name}}</strong></td>
               <td>{{ $row->score_a }} - {{ $row->score_b }}</td>
               <td><span class="badge rounded-pill bg-success me-1">{{ $row->round_match->title }}</span></td>
               <td><span class="badge rounded-pill bg-warning me-1">{{ $row->match_status}}</span></td>
               <td><span class="badge rounded-pill bg-primary me-1">{{ $row->id}}</span></td>
               <td>
                  <form method="post" action="{{ route('matchs.updatestatus',$row->id) }}" id="form">
                     @csrf
                     @method('PUT')
                  <div class="form-check form-switch mb-2">
                     <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="status" value="1git " {{  ($row->status == '1' ? ' checked' : '') }} />
                  </div>
                  </form>
               </td>
               <td>
                  <div class="dropdown">
                     <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                       <i class="bx bx-dots-vertical-rounded"></i>
                     </button>
                     <div class="dropdown-menu">
                       <a class="dropdown-item" href="{{ route('matchs.edit',[$row->id]) }}"
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

         $('.form-check-input').on('change',function(){
            $('#form').submit();
         });

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