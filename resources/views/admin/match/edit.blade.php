@extends('admin.layouts.dashboard')
@section('title')
  Category Add 
@endsection
@section('breadcrumbs')
   @php 
     use Illuminate\Support\Facades\DB;
     $postId =  $post->id;
     $cateoryId = DB::table('category_post')->where('post_id','=',$postId)->first();
     $catid = $cateoryId->category_id;
   @endphp
   @if($catid == 1)
     {{ Breadcrumbs::render('edit_post_banner',$catid) }}
   @elseif($catid == 2) 
     {{ Breadcrumbs::render('edit_post_profile',$catid) }}
   @elseif($catid == 3) 
     {{ Breadcrumbs::render('edit_post_sustainabilty',$catid) }}
   @elseif($catid == 4) 
     {{ Breadcrumbs::render('edit_post_ourimpact',$catid) }}
   @elseif($catid == 5) 
     {{ Breadcrumbs::render('edit_post_plant',$catid) }}
   @elseif($catid == 6) 
     {{ Breadcrumbs::render('edit_post_product',$catid) }}
   @elseif($catid == 7) 
     {{ Breadcrumbs::render('edit_post_market',$catid) }}
   @elseif($catid == 8) 
     {{ Breadcrumbs::render('edit_post_facilities',$catid) }}
   @elseif($catid == 9) 
     {{ Breadcrumbs::render('edit_post_news',$catid) }}
   @else($catid == '' ) 
     {{ Breadcrumbs::render('edit_post',$catid) }}
   @endif
   

@endsection
@section('content')
<div class="row">
   <div class="col-md-12">
      <form  action="{{  route('posts.update', ['post'=>$post]) }}" method="POST">
         @csrf
         @method('PUT')
         <div class="card">
            <div class="card-body">
               <div class="row d-flex align-items-stretch">
                  <div class="col-md-8">
                       
                     <!-- title -->
                     <div class="form-group">
                        <label for="input_post_title" class="font-weight-bold">Title</label>
                        <input id="input_post_title" name="title" type="text" placeholder="" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $post->title) }}"/>
                        @error('title')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                        @enderror
                     </div>
                     <!-- subtitle -->
                     <div class="form-group">
                        <label for="input_post_subtitle" class="font-weight-bold">SubTitle</label>
                        <input id="input_post_subtitle" name="subtitle" type="text" placeholder="" class="form-control @error('subtitle') is-invalid @enderror" name="subtitle" value="{{ old('subtitle', $post->subtitle) }}"/>
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
                        <input id="input_post_slug" name="slug" type="text" class="form-control @error('slug') is-invalid @enderror" readonly  value="{{ old('slug', $post->slug) }}" />
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
                           <input id="input_post_thumbnail" name="thumbnail" value="{{ old('thumbnail',asset($post->thumbnail) ) }}" type="text" class="form-control"
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
                           <input id="input_post_image" name="image" value="{{ old('image',asset($post->image) ) }}" type="text" class="form-control"
                              placeholder="" readonly />
                        </div>
                     </div>
                      
                     <!-- description -->
                     <div class="form-group">
                        <label for="input_post_description" class="font-weight-bold">
                           Short Description
                        </label>
                        <textarea id="input_post_description" name="description" class="form-control @error('description') is-invalid @enderror" rows="10">{{ old('description', $post->description) }}</textarea>
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
                        <textarea id="input_post_content" name="content" class="form-control @error('content') is-invalid @enderror" rows="20">{{ old('content', $post->content) }}</textarea>
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
                                       <option value="{{ $key }}" {{ old('status',  $post->status) == $key ? "selected" : null }}> {{ $value }}</option>
                                    @endforeach   
                                 </select>
                                 @error('status')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                 @enderror
                              </div>
                              <div class="form-group">
                                 <label for="select_post_status" class="font-weight-bold">
                                    Publish Date
                                 </label>
                                 <div class="input-group">
                                    <input data-date-format="yyyy-mm-dd" id="datepicker" type="text" class="form-control" name="publishDate" value="{{ old('publish_date',$post->publish_date) }}" >
                                    <span class="input-group-append">
                                      <span class="input-group-text bg-light d-block">
                                        <i class="fa fa-calendar"></i>
                                      </span>
                                    </span>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                  </div>
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
                                             'categoryChecked' => $post->categories->pluck('id')->toArray()
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
                        <a class="btn btn-warning px-4" href="{{ URL::previous() }}">Back</a>
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
      // event : input thumbnail with file manager
      $('#button_post_thumbnail').filemanager('image');
      $('#button_post_image').filemanager('image');

      

      // tiny mce for content
      $("#input_post_content").tinymce({
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

         $("#btn-add-post-images").click(function(){ 
            var hmtl = $(".clone").html();
            $(".increment").after(hmtl);
         });
         $("body").on("click",".btn-danger",function(){ 
            $(this).parents(".control-group").remove();
         });
         
          $('#datepicker').datepicker({
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
        $('#datepicker').datepicker();
});

 </script>
@endpush