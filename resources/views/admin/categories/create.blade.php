@extends('admin.layouts.dashboard')
@section('title')
  Category Add 
@endsection
@section('breadcrumbs')
  {{ Breadcrumbs::render('add_category') }}
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
     <div class="card">
        <div class="card-body">
           <form action="{{  route('categories.store') }}" method="POST">
            @csrf
              <!-- title -->
              <div class="form-group">
                 <label for="input_category_title" class="font-weight-bold">
                    Title
                 </label>
                 <input id="input_category_title" name="title" type="text"  class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}"/>
                  @error('title')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                  @enderror
              </div>
               <!-- title -->
              <div class="form-group">
                 <label for="input_category_title" class="font-weight-bold">
                    Title
                 </label>
                 <input id="input_category_title" name="subtitle" type="text"  class="form-control @error('subtitle') is-invalid @enderror" name="subtitle" value="{{ old('subtitle') }}"/>
                  @error('subtitle')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                  @enderror
              </div>
              <!-- slug -->
              <div class="form-group">
                 <label for="input_category_slug" class="font-weight-bold">
                    Slug
                 </label>
                 <input id="input_category_slug"  name="slug" type="text" class="form-control @error('slug') is-invalid @enderror" readonly  value="{{ old('slug') }}"/>
                 @error('slug')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                  @enderror
              </div>
              <!-- thumbnail -->
              <div class="form-group">
                 <label for="input_category_thumbnail" class="font-weight-bold">
                    Thumbnail
                 </label>
                 <div class="input-group">
                    <div class="input-group-prepend">
                       <button id="button_category_thumbnail" data-input="input_category_thumbnail" data-preview="holder" class="btn btn-primary" type="button">
                          Browse
                       </button>
                    </div>
                    <input id="input_category_thumbnail" name="thumbnail" value="{{ old('thumbnail') }}" type="text" class="form-control @error('thumbnail') is-invalid @enderror" placeholder=""
                       readonly />
                     @error('thumbnail')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                       
                 </div>
                 <div id="holder"></div>
              </div>
              <!-- parent_category -->
              <div class="form-group">
                 <label for="select_category_parent" class="font-weight-bold">Parent</label>
                 <select id="select_category_parent" name="parent_category" data-placeholder="" class="custom-select w-100">
                    @if (old('parent_category'))
                       <option value="{{ old('parent_category')->id }}" selected>{{ old('parent_category')->title }}</option>
                    @endif
                 </select>

              </div>
              <!-- description -->
              <div class="form-group">
                 <label for="input_category_description" class="font-weight-bold">
                    Description
                 </label>
                 <textarea id="input_category_description" name="description" class="form-control @error('description') is-invalid @enderror" rows="20">{{ old('description') }}</textarea>
                 @error('description')
                  <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                  </span>
                  @enderror
              </div>
              <div class="float-right">
                <a class="btn btn-primary px-4" href="">Back</a>
                <button type="submit" class="btn btn-primary px-4">Save</button>
              </div>                
           </form>
        </div>
     </div>
  </div>
</div>

@endsection 
@push('css-external')
  <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2-bootstrap4.min.css') }}"> 
@endpush
@push('javascript-external')
  <script  src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
  <script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
  <script src="{{ asset('vendor/tinymce5/jquery.tinymce.min.js') }}"></script>
  <script src="{{ asset('vendor/tinymce5/tinymce.min.js') }}"></script>
@endpush
@push('javascript-internal')
   <script>
      $(function() {
         // generate slug
         function generateSlug(value){
            return value.trim()
               .toLowerCase()
               .replace(/[^a-z\d-]/gi, '-')
               .replace(/-+/g, '-').replace(/^-|-$/g, "");
         }
         //select2 parent_category
         $('#select_category_parent').select2({
            theme: 'bootstrap4',
            language: "",
            allowClear: true,
            ajax: {
               url: "{{ route('categories.select') }}",
               dataType: 'json',
               delay: 250,
               processResults: function(data) {
                  return {
                     results: $.map(data, function(item) {
                        return {
                           text: item.title,
                           id: item.id
                        }
                     })
                  };
               }
            }
         });
         //event : input title
         $('#input_category_title').change(function(){
            let title =$(this).val();
            $('#input_category_slug').val(generateSlug(title));
         });
         //event:thumbnail
         //var route_prefix = "http://127.0.0.1:8080/filemanager";
         //$('#button_category_thumbnail').filemanager('image', {prefix: route_prefix});
         $('#button_category_thumbnail').filemanager('image');

         $("#input_category_description").tinymce({
         relative_urls: false,
         language: "en",
         plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table directionality",
            "emoticons template paste textpattern",
         ],
         toolbar1: "fullscreen preview",
         toolbar2:
            "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            file_picker_callback: function(callback, value, meta) {
               let x = window.innerWidth || document.documentElement.clientWidth || document
                  .getElementsByTagName('body')[0].clientWidth;
               let y = window.innerHeight || document.documentElement.clientHeight || document
                  .getElementsByTagName('body')[0].clientHeight;

               let cmsURL = "{{ route('unisharp.lfm.show') }}" + '?editor=' + meta.fieldname;
               if (meta.filetype == 'image') {
                  cmsURL = cmsURL + "&type=Images";
               } else {
                  cmsURL = cmsURL + "&type=Files";
               }
               tinyMCE.activeEditor.windowManager.openUrl({
                  url: cmsURL,
                  title: 'Filemanager',
                  width: x * 0.8,
                  height: y * 0.8,
                  resizable: "yes",
                  close_previous: "no",
                  onMessage: (api, message) => {
                     callback(message.content);
                  }
               });
            }

         
         });
      });
   </script>
@endpush