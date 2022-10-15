@extends('admin.layouts.dashboard')
@section('title')
  Dashboard  
@endsection
@section('breadcrumbs')
  {{ Breadcrumbs::render('categories') }}
@endsection
@section('content')
   <!-- content -->
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               {{-- Data Leads Promo : {{ $namePromo }} --}}
               <a href="{{ route('contact.export')}}" class="btn btn-success float-right">
                  <span class="glyphicon glyphicon-th-list"></span> EXPORT EXCEL
              </a>
            </div>
            <div class="card-body">
               <div class="row">
                  <div class="col-md-12">
                     <table class="table table-bordered data-table">
                        <thead>
                           <tr>
                              <th>FullName</th>
                              <th>Email</th>
                              <th>Company</th>
                              <th>Subject</th>
                              <th>Address</th>
                              <th>Phone</th>
                              <th>Messages</th>
                              
                           </tr>
                        </thead>
                        <tbody>
                        </tbody>
                     </table>
                  </div>
              </div>
            </div>
         </div>
      </div>
   </div>

@endsection
@push('javascript-external')
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
@endpush
@push('css-internal')
   <style>
      .post-tumbnail {
         width: 100%;
         height: 400px;
         background-repeat: no-repeat;
         background-position: center;
         background-size: cover;
      }
   </style>
@endpush
@push('javascript-internal')
   <script>
      $(document).ready(function(){
         var table = $('.data-table').DataTable({ 
               processing: true,
               serverSide: true,
               ajax: "{{ route('contact.index') }}",
               columns: [
                   //{data: 'DT_RowIndex', name: 'DT_RowIndex'},
                   {data: 'fullname', name: 'fullname'},
                   {data: 'email', name: 'email'},
                   {data: 'company', name: 'company'},
                   {data: 'subject', name: 'subject'},
                   {data: 'address', name: 'address'},
                   {data: 'phone', name: 'phone'},
                   {data: 'message', name: 'message'}
                  
               ]
           });
      });
   </script>
@endpush