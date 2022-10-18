@extends('admin.layouts.dashboard')
@section('title')
  Team Edit
@endsection
@section('breadcrumbs')
{{-- {{ Breadcrumbs::render('edit_slider',$slider) }} --}}
@endsection
@section('content')
<div class="row">
   <div class="col-md-8">
      <form  action="{{  route('teams.update', $team->id) }}" method="POST">
         @csrf
         @method('PUT')
         <div class="card mb-4">
            <h5 class="card-header">Teams Edit</h5>
            <div class="card-body">
               
               <!-- Name -->
               <div class="mb-3">
                  <label for="input_name" class="form-label">Name</label>
                  <input 
                     id="input_name"  
                     type="text" 
                     placeholder="" 
                     class="form-control @error('title') is-invalid @enderror" 
                     name="name"
                     value="{{ old('name', $team->name) }}"
                     
                  />
                  @error('name')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>
               <div class="mb-3">
                  <label for="select_post_status" class="form-label">Group</label>
                  <select id="select_post_status" name="group" class="form-select @error('group') is-invalid @enderror" disabled> 
                     <option value="">Please Select ..</option>
                        
                  </select>
                  @error('status')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>
               <!-- flags -->
               <div class="mb-3">
                  <label for="input_post_imagesMobile" class="form-label">Flag</label>
                  <div class="input-group">
                     <button 
                        id="button_post_images" 
                        data-input="input_post_images"
                        class="btn btn-outline-primary"
                        type="button">Browse
                     </button>
                     <input id="input_post_images" 
                        name="image" 
                        value="{{ old('flag_image',asset($team->flag_image_path) ) }}" 
                        type="text" 
                        class="form-control"
                        placeholder="" 
                        readonly />
                  </div>
               </div>
               <button type="submit" class="btn btn-primary px-4">
                  Save
               </button>      
            </div>
         </div>
      </form>
   </div>
 </div>
@endsection
@push('javascript-external')
  <script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
  <script src="{{ asset('vendor/tinymce5/jquery.tinymce.min.js') }}"></script>
  <script src="{{ asset('vendor/tinymce5/tinymce.min.js') }}"></script>
@endpush
@push('javascript-internal')
 <script>
   $(document).ready(function(){
      $('#button_post_images').filemanager('image');
});
 </script>
@endpush