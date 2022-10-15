@extends('admin.layouts.dashboard')
@section('title')
    @php  
        $postId = last(request()->segments());
    @endphp
   @if($postId == 1)
     Sliders
   @elseif($postId == 2) 
     OUR PROFILE
   @elseif($postId == 3) 
     Sustainabilty
   @elseif($postId == 4) 
     Our Impact
   @elseif($postId == 5) 
     Plant Tour
   @elseif($postId == 6) 
     Product
   @elseif($postId == 7) 
     Market
   @elseif($postId == 8) 
     Facilities
   @elseif($postId == 9) 
     News
   @else($postId == ) 
    Posts
   @endif 
    
    
@endsection
@section('breadcrumbs')
   @if($postId == 1)
     {{ Breadcrumbs::render('posts_slider',$postId) }}
   @elseif($postId == 2) 
     {{ Breadcrumbs::render('posts_profile',$postId) }}
   @elseif($postId == 3) 
     {{ Breadcrumbs::render('posts_sustainabilty',$postId) }}
   @elseif($postId == 4) 
     {{ Breadcrumbs::render('posts_ourimpact',$postId) }}
   @elseif($postId == 5) 
     {{ Breadcrumbs::render('posts_plant',$postId) }}
   @elseif($postId == 6) 
     {{ Breadcrumbs::render('posts_product',$postId) }}
   @elseif($postId == 7) 
     {{ Breadcrumbs::render('posts_market',$postId) }}
   @elseif($postId == 8) 
     {{ Breadcrumbs::render('posts_facilities',$postId) }}
   @elseif($postId == 9) 
     {{ Breadcrumbs::render('posts_news',$postId) }}
   @else($postId == ) 
     {{ Breadcrumbs::render('posts',$postId) }}
   @endif
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
                 <a href="{{ route ('posts.create') }}" class="btn btn-primary float-right" role="button">
                    <i class="fas fa-plus-square"></i>
                 </a>
              </div>
           </div>
        </div>
        <div class="card-body">
           <ul class="list-group list-group-flush">
              <!-- list post -->
              @forelse ($posts as $post )
                <div class="card">
                  <div class="card-body">
                    <h6>
                      {{ $post->title }}
                    </h6>
                    <p>
                        {{-- Description --}}
                        {!! $post->description !!}
                    </p>
                    <div class="float-right">
                        <!-- detail -->
                        <a href="{{ route('posts.show',['post'=>$post]) }}" class="btn btn-sm btn-primary" role="button">
                          <i class="fas fa-eye"></i>
                        </a>
                        <!-- edit -->
                        <a href ="{{ route('posts.edit',['post'=>$post]) }}" class="btn btn-sm btn-info" role="button">
                          <i class="fas fa-edit"></i>
                        </a>
                        <!-- delete -->
                        <form class="d-inline" action="{{ route('posts.destroy', ['post'=>$post]) }}" role="alert" method="POST" alert-text="{{ $post->title }}">
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
                <p> Data Post Belum Ada </p>
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