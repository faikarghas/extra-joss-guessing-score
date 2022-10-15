@extends('admin.layouts.dashboard')
@section('title')
  @php  
    $caregoriesId = last(request()->segments());
  @endphp
  
   @if($caregoriesId == 2) 
        OUR PROFILE
   @elseif($caregoriesId == 3) 
        SUSTAINABILTY
   @elseif($caregoriesId == 4) 
     {{ Breadcrumbs::render('posts_ourimpact',$caregoriesId) }}
   @elseif($caregoriesId == 5) 
     {{ Breadcrumbs::render('posts_plant',$caregoriesId) }}
   @elseif($caregoriesId == 6) 
     {{ Breadcrumbs::render('posts_product',$caregoriesId) }}
   @elseif($caregoriesId == 7) 
     {{ Breadcrumbs::render('posts_market',$caregoriesId) }}
   @elseif($caregoriesId == 8) 
     {{ Breadcrumbs::render('posts_facilities',$caregoriesId) }}
   @elseif($caregoriesId == 9) 
     {{ Breadcrumbs::render('posts_news',$caregoriesId) }}
   @else($postId == 9) 
     {{ Breadcrumbs::render('categories') }}
   @endif 
    
  
  Dashboard  
@endsection
@section('breadcrumbs')
   
   @if($caregoriesId == 2) 
     {{ Breadcrumbs::render('posts_profile',$caregoriesId) }}
   @elseif($caregoriesId == 3) 
     {{ Breadcrumbs::render('posts_sustainabilty',$caregoriesId) }}
   @elseif($caregoriesId == 4) 
     {{ Breadcrumbs::render('posts_ourimpact',$caregoriesId) }}
   @elseif($caregoriesId == 5) 
     {{ Breadcrumbs::render('posts_plant',$caregoriesId) }}
   @elseif($caregoriesId == 6) 
     {{ Breadcrumbs::render('posts_product',$caregoriesId) }}
   @elseif($caregoriesId == 7) 
     {{ Breadcrumbs::render('posts_market',$caregoriesId) }}
   @elseif($caregoriesId == 8) 
     {{ Breadcrumbs::render('posts_facilities',$caregoriesId) }}
   @elseif($caregoriesId == 9) 
     {{ Breadcrumbs::render('posts_news',$caregoriesId) }}
   @else($postId == 9) 
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
                 <a href="{{ route('categories.create') }}" class="btn btn-primary float-right" role="button">
                    Add new
                    <i class="fas fa-plus-square"></i>
                 </a>
              </div>
           </div>
        </div>
        <div class="card-body">
           <ul class="list-group list-group-flush">
              <!-- list category -->
              @include('admin.categories._category-list',[
                 'categories' => $categories,
                 'count' => 0
              ])
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