@extends('admin.layouts.dashboard')
@section('title')
  Matches Add 
@endsection
@section('breadcrumbs')
  {{ Breadcrumbs::render('add_category') }}
@endsection
@section('content')
<form  action="{{  route('matchs.update',$fmatch->id) }}" method="POST">
   @csrf
   @method('PUT')
   <div class="row">
      <div class="col-md-8">
         <div class="card mb-4">
            <h5 class="card-header">Match Add</h5>
            <div class="card-body">
               <div class="mb-3">
                  <label for="exampleFormControlSelect1" class="form-label">Team A</label>
                  <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="id_team_a">
                    <option value="">Select Country A</option>
                    {{-- @foreach ($country as $row)
                     <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach --}}
                    @foreach ($country as $row)
                        <option @selected($row->id == $fmatch->id_team_a) value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
                  </select>
               </div>
               <div class="mb-3">
                  <label for="exampleFormControlSelect1" class="form-label">Team B</label>
                  <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="id_team_b">
                    <option value="">Select Country B</option>
                    @foreach ($country as $row)
                        <option @selected($row->id == $fmatch->id_team_b) value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
                  </select>
               </div>
               <div class="mb-3">
                  <label for="html5-datetime-local-input" class="col-md-2 col-form-label">Datetime</label>
                  <div>
                     <input
                        class="form-control"
                        type="datetime-local"
                        value="2021-06-18T12:30:00"
                        id="html5-datetime-local-input"
                        name="match_time"
                        value="{{ old('match_time', $fmatch->match_time) }}"
                     />
                  </div>
               </div>
               <div class="mb-3">
                  <label for="defaultFormControlInput" class="form-label">Result Team 1</label>
                  <input
                     type="text"
                     class="form-control"
                     id="defaultFormControlInput"
                     placeholder="John Doe"
                     aria-describedby="defaultFormControlHelp"
                     name="score_a"
                     value="{{ old('score_a', $fmatch->score_a) }}"
                  />
               </div>
               <div class="mb-3">
                  <label for="defaultFormControlInput" class="form-label">Result Team 2</label>
                  <input
                     type="text"
                     class="form-control"
                     id="defaultFormControlInput"
                     placeholder="John Doe"
                     aria-describedby="defaultFormControlHelp"
                     name="score_b"
                     value="{{ old('score_b', $fmatch->score_b) }}"
                  />
               </div>
               <button type="submit" class="btn btn-primary">SAVE</button>
            </div>
         </div>
      </div>
      <div class="col-md-4">
         <div class="card mb-4">
            <h5 class="card-header">Match Setings</h5>
            <div class="card-body">
               <div class="mb-3">
                  <label for="exampleFormControlSelect1" class="form-label">ROUND</label>
                  <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="round">
                    <option value="">Select Round</option>
                    @foreach ($round as $row)
                     <option @selected($row->id == $fmatch->round)
                           value="{{$row->id}}">{{$row->title}}</option>
                     @endforeach
                  </select>

               </div>
               <div class="mb-3">
                  <label for="exampleFormControlSelect1" class="form-label">STATUS</label>
                  <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="match_status">
                    <option value="">Select Status</option>
                    @foreach ($match_status as $key =>$value)
                        <option value="{{ $key }}" {{ old('match_status',  $fmatch->match_status) == $key ? "selected" : null }}> {{ $value }}</option>
                     @endforeach  
                  </select>
               </div>
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