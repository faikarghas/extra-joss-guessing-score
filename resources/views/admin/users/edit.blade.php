@extends('admin.layouts.dashboard')
@section('title')
   
@endsection
@section('breadcrumbs')
   
   

@endsection
@section('content')
<div class="row">
   <div class="col-md-12">
     <ul class="nav nav-pills flex-column flex-md-row mb-3">
       <li class="nav-item">
         <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a>
       </li>
       <li class="nav-item">
         <a class="nav-link" href="pages-account-settings-notifications.html"
           ><i class="bx bx-bell me-1"></i> Notifications</a
         >
       </li>
       <li class="nav-item">
         <a class="nav-link" href="pages-account-settings-connections.html"
           ><i class="bx bx-link-alt me-1"></i> Connections</a
         >
       </li>
     </ul>
     <div class="card mb-4">
       <h5 class="card-header">Profile Details</h5>
       <!-- Account -->
       <div class="card-body">
         <div class="d-flex align-items-start align-items-sm-center gap-4">
           <img
             src="../assets/img/avatars/1.png"
             alt="user-avatar"
             class="d-block rounded"
             height="100"
             width="100"
             id="uploadedAvatar"
           />
           <div class="button-wrapper">
             <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
               <span class="d-none d-sm-block">Upload new photo</span>
               <i class="bx bx-upload d-block d-sm-none"></i>
               <input
                 type="file"
                 id="upload"
                 class="account-file-input"
                 hidden
                 accept="image/png, image/jpeg"
               />
             </label>
             <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
               <i class="bx bx-reset d-block d-sm-none"></i>
               <span class="d-none d-sm-block">Reset</span>
             </button>

             <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
           </div>
         </div>
       </div>
       <hr class="my-0" />
       <div class="card-body">
         <form id="" method="POST">
           <div class="row">
             <div class="mb-3 col-md-6">
               <label for="name" class="form-label">Name</label>
               <label for="input_name" class="form-label">Name</label>
                  <input 
                     id="input_name"  
                     type="text" 
                     placeholder="" 
                     class="form-control @error('title') is-invalid @enderror" 
                     name="name"
                     value="{{ old('name', $user->name) }}"
                  />
             </div>
             <div class="mb-3 col-md-6">
               <label for="lastName" class="form-label">Username</label>
                  <input 
                     id="input_username"  
                     type="text" 
                     placeholder="" 
                     class="form-control @error('title') is-invalid @enderror" 
                     name="username"
                     value="{{ old('username', $user->username) }}"
                     
                  />
             </div>
             <div class="mb-3 col-md-6">
               <label for="email" class="form-label">E-mail</label>
               <input
                 class="form-control"
                 type="text"
                 id="input_email"
                 name="email"
                 value={{ $user->email }}
                 
               />
             </div>
             <div class="mb-3 col-md-6">
               <label for="nik" class="form-label">Nik</label>
               <input
                  id="input_nik"  
                  type="text" 
                  placeholder="" 
                  class="form-control @error('title') is-invalid @enderror" 
                  name="nik"
                  value="{{ old('nik', $user->nik) }}"
               />
             </div>
             <div class="mb-3 col-md-6">
               <label class="form-label" for="phoneNumber">Phone Number</label>
               <div class="input-group input-group-merge">
                 <input
                     id="input_phone"  
                     type="text" 
                     placeholder="" 
                     class="form-control @error('phone') is-invalid @enderror" 
                     name="phone"
                     value="{{ old('phone', $user->phone) }}"
                 />
               </div>
             </div>
             <div class="mb-3 col-md-6">
               <label for="address" class="form-label">Address</label>
               <input 
                  id="input_address"  
                  type="text" 
                  placeholder="" 
                  class="form-control @error('address') is-invalid @enderror" 
                  name="address"
                  value="{{ old('address', $user->username) }}"
               />
             </div>
             <div class="mb-3 col-md-6">
               <label for="state" class="form-label">Ukuran Jersey</label>
               <input 
                  class="form-control" 
                  type="text" 
                  id="state" 
                  name="size_jersey" 
                  
               />
             </div>
             <div class="mb-3 col-md-6">
               <label for="zipCode" class="form-label">Ukuran Sepatu</label>
               <input
                 type="text"
                 class="form-control"
                 name="size_sepatu"
                 placeholder="43"
               />
             </div>
             <div class="mb-3 col-md-6">
               <label class="form-label" for="country">Kota</label>
               <select id="country" class="select2 form-select">
                 <option value="">Pilih Kota</option>
                  
               </select>
             </div>
             <div class="mb-3 col-md-6">
               <label for="language" class="form-label">Kecamatan</label>
               <select id="language" class="select2 form-select">
                 <option value="">Pilih Kecamatan</option>
               </select>
             </div>
           </div>
           <div class="mt-2">
             <button type="submit" class="btn btn-primary me-2">Save changes</button>
             <button type="reset" class="btn btn-outline-secondary">Cancel</button>
           </div>
         </form>
       </div>
       <!-- /Account -->
     </div>
     <div class="card">
       <h5 class="card-header">Status Account Details</h5>
       <div class="card-body">
         
       </div>
     </div>
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