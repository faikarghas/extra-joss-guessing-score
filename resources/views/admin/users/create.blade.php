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
      <form  action="{{  route('posts.store') }}" method="POST">
         @csrf
         <div class="card">
            <div class="card-body">
               <div class="row d-flex align-items-stretch">
                  <div class="col-md-8">
                     <!-- title -->
                     <div class="form-group">
                        <label for="input_post_title" class="font-weight-bold">Title</label>
                        <input id="input_post_title" name="title" type="text" placeholder="" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}"/>
                        @error('title')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                        @enderror
                     </div>
                      <!-- subtitle -->
                     <div class="form-group">
                        <label for="input_post_subtitle" class="font-weight-bold">subTitle</label>
                        <input id="input_post_subtitle" name="subtitle" type="text" placeholder="" class="form-control @error('subtitle') is-invalid @enderror" name="subtitle" value="{{ old('subtitle') }}"/>
                        @error('subtitle')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                        @enderror
                     </div>
                     <!-- slug -->
                     <div class="form-group">
                        <label for="input_post_slug" class="font-weight-bold">
                           Slug
                        </label>
                        <input id="input_post_slug" name="slug" type="text" class="form-control @error('slug') is-invalid @enderror" readonly  value="{{ old('slug') }}" />
                        @error('slug')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                        @enderror
                     </div>
                     <!-- thumbnail -->
                     <div class="form-group">
                        <label for="input_post_thumbnail" class="font-weight-bold">
                           Thumbnail
                        </label>
                        <div class="input-group">
                           <div class="input-group-prepend">
                              <button id="button_post_thumbnail" data-input="input_post_thumbnail"
                                 class="btn btn-primary" type="button">
                                 Browse
                              </button>
                           </div>
                           <input id="input_post_thumbnail" name="thumbnail" value="{{ old('thumbnail') }}" type="text" class="form-control"
                              placeholder="" readonly />
                        </div>
                     </div>
                     <!-- image -->
                     <div class="form-group">
                        <label for="input_post_image" class="font-weight-bold">
                           Image
                        </label>
                        <div class="input-group">
                           <div class="input-group-prepend">
                              <button id="button_post_image" data-input="input_post_image"
                                 class="btn btn-primary" type="button">
                                 Browse
                              </button>
                           </div>
                           <input id="input_post_image" name="image" value="{{ old('image') }}" type="text" class="form-control"
                              placeholder="" readonly />
                        </div>
                     </div>
                     <!-- description -->
                     <div class="form-group">
                        <label for="input_post_description" class="font-weight-bold">
                           Short Description
                        </label>
                        <textarea id="input_post_description" name="description" class="form-control @error('description') is-invalid @enderror" rows="10">{{ old('description') }}</textarea>
                     </div>
                     @error('description')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                        @enderror

                     <!-- content -->
                     <div class="form-group">
                        <label for="input_post_content" class="font-weight-bold">
                           Description
                        </label>
                        <textarea id="input_post_content" name="content" class="form-control @error('content') is-invalid @enderror" rows="20">{{ old('content') }}</textarea>
                        @error('content')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-4">
                     <!-- catgeory -->
                     {{-- <div class="form-group">
                        <label for="input_post_description" class="font-weight-bold">
                           Category
                        </label>
                        <div class="form-control overflow-auto" style="height: 886px">
                           <!-- List category -->
                              @include('admin.posts._category-list',[
                                 'categories' => $categories
                              ])
                           <!-- List category -->
                        </div>
                     </div> --}}

                     {{-- collapse for detail publish, feature image, category --}}
                     <div class="accordion" id="accordionExample">
                        <div class="card">
                          <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                              <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <b>Publish</b>
                              </button>
                            </h2>
                          </div>
                      
                          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                              <div class="form-group">
                                 <label for="select_post_status" class="font-weight-bold">
                                    Status
                                 </label>
                                 <select id="select_post_status" name="status" class="custom-select @error('status') is-invalid @enderror"> 
                                    <option value="">Please Select ..</option>
                                    @foreach ($statuses as $key =>$value)
                                       <option value="{{ $key }}" {{ old('status') == $key ? "selected" : null }}> {{ $value }}</option>
                                    @endforeach   
                                 </select>
                                 @error('status')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                 @enderror
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                              <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                 <b>Category</b>
                              </button>
                            </h2>
                          </div>
                          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                              <div class="form-group">
                                 <label for="input_post_description" class="font-weight-bold">
                                    Category
                                 </label>
                                    <div class="form-control overflow-auto @error('category') is-invalid @enderror" style="height: 456px">
                                       <!-- List category -->
                                          @include('admin.posts._category-list',[
                                             'categories' => $categories,
                                             'categoryChecked' => old('category')
                                          ])
                                       <!-- List category -->
                                    </div>
                                    @error('category')
                                       <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                       </span>
                                    @enderror
                                    
                              </div>   
                            </div>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-header" id="headingThree">
                            <h2 class="mb-0">
                              <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                 <b>Features Images</b>
                              </button>
                            </h2>
                          </div>
                          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="card-body">
                              <div class="form-group">
                                 <label for="input_post_description" class="font-weight-bold">
                                    Feature Images
                                 </label>
                                 <input id="input_post_images" name="images" type="text" class="form-control" placeholder="" value="{{ old('images') }}" readonly />
                                 <div id="holder"></div>
                                 <label for="input_post_description" class="font-weight-bold my-2">
                                    <button id="button_post_images" data-input="input_post_images" class="btn btn-primary" type="button" data-preview="holder">
                                       Browse
                                    </button>
                                 </label>
                                 
                                  {{-- <div class="input-group hdtuto control-group increment" >
                                    <div class="input-group-prepend">
                                       <button id="button_post_images" data-input="input_post_images" class="btn btn-primary" type="button">
                                          Browse
                                       </button>
                                    </div>
                                    <input id="input_post_images" name="images[]" value="" type="text" class="form-control"
                                       placeholder="" readonly />
                                    <div class="input-group-btn"> 
                                      <button class="btn btn-success" type="button" id="btn-add-post-images"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
                                    </div>
                                  </div>
                                  <div class="clone hide " style="display: none">
                                    <div class="hdtuto control-group input-group" style="margin-top:10px">
                                       <div class="input-group-prepend">
                                          <button id="button_post_images" data-input="input_post_images" class="btn btn-primary" type="button">
                                             Browse
                                          </button>
                                       </div>
                                       <input id="input_post_images" name="images[]" value="" type="text" class="form-control" placeholder="" readonly />
                                       <div class="input-group-btn"> 
                                          <button class="btn btn-danger" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
                                      </div>
                                    </div>
                                  </div> --}}
                              </div>   
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <!-- tag -->
                     {{-- <div class="form-group">
                        <label for="select_post_tag" class="font-weight-bold">
                           Tag
                        </label>
                        <select id="select_post_tag" name="tag" data-placeholder="" class="custom-select w-100"
                           multiple>
                           <option value="tag1">tag 1</option>
                           <option value="tag2">tag 2</option>
                        </select>
                     </div> --}}
                     <!-- status -->
                     {{-- <div class="form-group">
                        <label for="select_post_status" class="font-weight-bold">
                           Status
                        </label>
                        <select id="select_post_status" name="status" class="custom-select">
                           <option value="draft">Draft</option>
                           <option value="publish">Publish</option>
                        </select>
                     </div> --}}
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
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