@extends('admin.layouts.dashboard')
@section('title')
  Matches Add 
@endsection
@section('breadcrumbs')
  {{ Breadcrumbs::render('add_category') }}
@endsection
@section('content')
<form  action="{{  route('quizs.update',$question->id) }}" method="POST">
   @csrf
   @method('PUT')
   <div class="row">
      <div class="col-md-9">
         <div class="card mb-4">
            <h5 class="card-header">Quiz Edit</h5>
            <div class="card-body">
               <div class="mb-3">
                  <label for="defaultFormControlInput" class="col-md-2 col-form-label">Questions</label>
                  <div>
                     <input
                        type="text"
                        class="form-control"
                        id="defaultFormControlInput"
                        placeholder="John Doe"
                        aria-describedby="defaultFormControlHelp"
                        name="question"
                        value="{{ old('question', $question->question) }}"
                     />
                  </div>
               </div>
               
               
               <button type="submit" class="btn btn-primary">Save</button>
            </div>
         </div>
      </div>
      
   </div>
</form>
@endsection
@push('javascript-external')
  <script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
  <script src="{{ asset('vendor/tinymce5/jquery.tinymce.min.js') }}"></script>
  <script src="{{ asset('vendor/tinymce5/tinymce.min.js') }}"></script>
@endpush
@push('javascript-internal')
 <script>
   $(document).ready(function(){
      $("#input_post_title").change(function (event) {
         $("#input_post_slug").val(
            event.target.value
               .trim()
               .toLowerCase()
               .replace(/[^a-z\d-]/gi, "-")
               .replace(/-+/g, "-")
               .replace(/^-|-$/g, "")
         );
      });
      // event : input thumbnail with file manager and description
      $('#button_post_thumbnail').filemanager('image');
      $('#button_post_image').filemanager('image');
      // event :  description

      // tinymce for content
      $("#input_post_content").tinymce({
         relative_urls: false,
         language: "en",
         plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table directionality",
            "emoticons template paste textpattern",
         ],
         forced_root_block : '',
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

         $("#btn-add-post-images").click(function(){ 
            var hmtl = $(".clone").html();
            $(".increment").after(hmtl);
         });
         $("body").on("click",".btn-danger",function(){ 
            $(this).parents(".control-group").remove();
         });
      });

 </script>
@endpush