@extends('admin.layouts.dashboard')
@section('title')
  Dashboard   1
@endsection
@section('breadcrumbs')
  {{ Breadcrumbs::render('categories') }}
@endsection
@section('content')
   <!-- content -->
   <div class="row">
      <div class="col-md-9">
         <div class="card">
            <div class="card-header">
               GALLERY
            </div>
            <div class="card-body">
               <div class="row row-cols-1 row-cols-md-4 g-4">
                  {{-- list image --}}
                  @forelse ($images as $image )
                     <div class="col my-2" id="sortable">
                        <div class="card h-100">
                           <div id="description">
                              {{-- <svg class="img-fluid" width="100%" height="200" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                              <rect width="100%" height="100%" fill="#868e96">{{ $image->images }}</rect>
                              </svg> --}}
                              <img src="{{  $image->full_path }}" class="img-fluid" width="100%" height="200" role="img">
                           </div>   
                           <div class="card-body">
                              <h5 class="card-title" id="name">{{ $image->title }}</h5>
                              <p class="card-text">{{ $image->order }}</p>
                           </div>
                        <div class="card-footer text-right">
                           <a  class="btn btn-sm btn-warning " role="button" id="edit-item" data-item-id="{{ $image->id }}" data-item-images="{{ $image->full_path }}" data-item-title="{{ $image->title }}" data-item-order="{{ $image->order }}">
                              <i class="fas fa-edit"></i>
                           </a>
                           <form class="d-inline" action="{{ route('postimages.destroy', [$image]) }}" role="alert" method="POST" alert-text="{{ $image->title }}">
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
                  <p> Image Tidak di temukan </p>
                  @endforelse    
                </div> 
            </div>
         </div>
      </div>
      <div class="col-md-3" id="form-add">
         <div class="card">
            <div class="card-header">
               Add Images
            </div>
            <form  action="{{ route('postimages.store') }}" method="POST">
               
            @csrf
            <input type="hidden" name="post_id" class="form-control" value="{{ $post->id }}">
            <div class="row d-flex align-items-stretch">
               <div class="col-md-12">
                  <div class="card-body">
                     <div class="form-group">
                        <label for="input_post_thumbnail" class="font-weight-bold">
                           Images
                        </label>
                        <div class="input-group">
                           <div class="input-group-prepend">
                              <button id="button_post_images" data-input="input_post_images"
                                 class="btn btn-primary" type="button">
                                 Browse
                              </button>
                           </div>
                           <input id="input_post_images" name="images" value="{{ old('images') }}" type="text" class="form-control @error('title') is-invalid @enderror"
                              placeholder="" readonly />
                           @error('images')
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="input_post_title" class="font-weight-bold">Title</label>
                        <input id="input_post_title" name="title" type="text" placeholder="" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}"/>
                        @error('title')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                        @enderror
                     </div>
                     <div class="form-group">
                        <label for="input_post_order" class="font-weight-bold">Order</label>
                        <input id="input_post_order" name="order" type="text" placeholder="" class="form-control @error('order') is-invalid @enderror" name="order" value="{{ old('order') }}"/>
                        @error('order')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                        @enderror
                     </div>
                     <div class="form-group py-3">
                        <div class="float-right">
                           <a class="btn btn-warning px-4" href="">Back</a>
                           <button type="submit" class="btn btn-primary px-4">
                              Save
                           </button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            </form>
         </div>
      </div>

      <div class="col-md-3" id="form-edit" style="display: none">
         <div class="card">
            <div class="card-header">
               Edit Images
            </div>
            <form  id="form-update" method="POST">
               
               @csrf
               @method('PUT')
               <input type="hidden" name="id" class="form-control" id="input-id">
               <div class="row d-flex align-items-stretch">
                  <div class="col-md-12">
                     <div class="card-body">
                        
                        <div class="form-group">
                           <label for="input_post_thumbnail" class="font-weight-bold">
                              Images
                           </label>
                           <div class="input-group">
                              <div class="input-group-prepend">
                                 <button id="button_edit_post_images" data-input="edit-post-images"
                                    class="btn btn-primary" type="button">
                                    Browse
                                 </button>
                              </div>
                              <input id="edit-post-images" name="images"  type="text" class="form-control @error('title') is-invalid @enderror"
                                 placeholder="" readonly />
                              @error('images')
                                 <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                                 </span>
                              @enderror
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="input_post_title" class="font-weight-bold">Title</label>
                           <input id="input-title" name="title" type="text" placeholder="" class="form-control @error('title') is-invalid @enderror" name="title"/>
                           @error('title')
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                        </div>
                        <div class="form-group">
                           <label for="input_post_order  " class="font-weight-bold">order</label>
                           <input id="input-post-order" name="order" type="text" placeholder="" class="form-control @error('order') is-invalid @enderror" name="order"/>
                           @error('order')
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                        </div>
                        <div class="form-group py-3">
                           <div class="float-right">
                              <a class="btn btn-warning px-4" href="">Back</a>
                              <button type="submit" class="btn btn-primary px-4">
                                 Save
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>


   </div>

@endsection
@push('javascript-external')
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   <script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
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
         $('#button_post_images').filemanager('image');
         $('#button_edit_post_images').filemanager('image');

         $(document).on('click', "#edit-item", function() {

            document.getElementById("form-add").style.display = "none";
            document.getElementById("form-edit").style.display = "block";

            $(this).addClass('edit-item-trigger-clicked');
            var el = $(".edit-item-trigger-clicked");
            const id = el.data('item-id');
            var title = el.data('item-title');
            var images = el.data('item-images');
            var order = el.data('item-order');
            
            // fill the data in the input fields
            $("#input-id").val(id);
            $("#input-title").val(title);
            $("#edit-post-images").val(images);
            $("#input-post-order").val(order);
            
            form = document.getElementById('form-update');
            form.action = "{{ route('postimages.update','')}}"+"/"+id;

         })

         
      $("#sortable").sortable();
      $("#sortable").disableSelection();

      });
   </script>
@endpush