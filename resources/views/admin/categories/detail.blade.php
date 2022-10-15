@extends('admin.layouts.dashboard')
@section('title')
    @php  
        $categoriesId = last(request()->segments());
    @endphp
    @if($categoriesId == 2) 
        OUR PROFILE
    @elseif($categoriesId == 3) 
        Sustainabilty
    @elseif($categoriesId == 4) 
        OUR IMPACT
    @elseif($categoriesId == 5) 
        PLANT TOUR
    @elseif($categoriesId == 6) 
        PRODUCT
    @elseif($categoriesId == 7) 
        MARKET
    @elseif($categoriesId == 8) 
        FACILITIES
    @elseif($categoriesId == 9) 
        NEWS
    @else($categoriesId == NULL) 
     {{ Breadcrumbs::render('categories') }}
   @endif
@endsection
@section('breadcrumbs')
  
   
   
   @if($categoriesId == 2) 
     {{ Breadcrumbs::render('posts_profile',$categoriesId) }}
   @elseif($categoriesId == 3) 
     {{ Breadcrumbs::render('posts_sustainabilty',$categoriesId) }}
   @elseif($categoriesId == 4) 
     {{ Breadcrumbs::render('posts_ourimpact',$categoriesId) }}
   @elseif($categoriesId == 5) 
     {{ Breadcrumbs::render('posts_plant',$categoriesId) }}
   @elseif($categoriesId == 6) 
     {{ Breadcrumbs::render('posts_product',$categoriesId) }}
   @elseif($categoriesId == 7) 
     {{ Breadcrumbs::render('posts_market',$categoriesId) }}
   @elseif($categoriesId == 8) 
     {{ Breadcrumbs::render('posts_facilities',$categoriesId) }}
   @elseif($categoriesId == 9) 
     {{ Breadcrumbs::render('posts_news',$categoriesId) }}
   @else($categoriesId == NULL) 
     {{ Breadcrumbs::render('categories') }}
   @endif
@endsection
@section('content')
  <!-- section:content -->
<div class="row">
  <div class="col-md-12">
     <div class="card">
        <div class="card-header">
          <div class="row">
              <div class="col-md-6">
                 <form action="" method="GET">
                    <div class="input-group">
                       <input name="keyword" type="search" class="form-control" placeholder="Search for categories">
                       <div class="input-group-append">
                          <button class="btn btn-primary" type="submit">
                             <i class="fas fa-search"></i>
                          </button>
                       </div>
                    </div>
                 </form>
              </div>
              <div class="col-md-6">
                 {{-- <a href="{{ route('categories.create') }}" class="btn btn-primary float-right" role="button"><i class="fas fa-plus-square"></i>
                 </a> --}}
              </div>
           </div>
        </div>
        <div class="card-body">
           <ul class="list-group list-group-flush">
            <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center pr-0">
               <label class="mt-auto mb-auto">
                  {{ $category->title }}
               </label>
               <div>
                   
                   @if ($categoriesId ==2 || $categoriesId ==3 )
                   @else 
                    <!-- detail -->
                    <a href="{{ route('posts.details',[$category->id]) }}" class="btn btn-sm btn-success" role="button">
                        <i class="fas fa-file"></i>
                    </a>
                    <!-- end detail -->
                  @endif
                  
                  
                  <!-- edit -->
                  <a href="{{ route('categories.edit',[$category->id]) }}" class="btn btn-sm btn-info" role="button">
                    <i class="fas fa-edit"></i>
                  </a>
                </div>
            </li>
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