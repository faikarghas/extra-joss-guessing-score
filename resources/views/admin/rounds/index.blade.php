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
           <th>Title</th>
           <th>Start At</th>
           <th>End At</th>
           <th>Status</th>
           <th>Actions</th>
         </tr>
       </thead>
       <tbody class="table-border-bottom-0">
         @foreach ($datas as $row)
            <tr>
               <td><strong>{{ $row->title }}</strong></td>
               <td><strong>{{ $row->start_at}}</strong></td>
               <td><strong>{{ $row->end_at }}</strong></td>
               <td>
                  <div class="form-check form-switch mb-2">
                     @if ($row->status == '1')
                        <input class="form-check-input" type="checkbox" data-id="{{ $row->id }}" id="flexSwitchCheckDefault" name="status" value="0" checked/>
                     @else
                        <input class="form-check-input" type="checkbox" data-id="{{ $row->id }}" id="flexSwitchCheckDefault" name="status" value="1"/>
                     @endif  
                  </div>
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

            var $this = $(this);
            
            
            $.ajax({
               url: '{{ route('rounds.updatestatus') }}',
               headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
               data: {
                   
                   data_id: $this.attr('data-id'),
                   checkboxStatus: $this.val(),
                 
               },
               type: 'POST',
               dataType: 'json',
               success: function (data) {
                  if (data.success) {
                            swal.fire("Done!", data.message, "success");
                            location.reload(2000);
                        } else {
                            swal.fire("Error!", 'Sumething went wrong.', "error");
                        }
                },
                error: function (data) {
                    alert('error handing here');
                    
                }
            });
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