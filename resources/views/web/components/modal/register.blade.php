{{-- MODAL REGISTER --}}
<div class="hidden modal-register w-full h-full fixed top-0 left-0 bg-[#FFEC00] px-14 py-20">
  <div class="bg-white flex flex-wrap py-8 px-20 relative justify-between">
      <div class="close-register absolute top-[15px] right-[15px] cursor-pointer">
          <div class="w-[44px] h-[44px] bg-black rounded-full flex items-center justify-center">
              <img src="{{asset('/images/close-w.png')}}" />
          </div>
      </div>
      <div class="basis-full flex justify-between">
          <h2 class="font-head text-[60px]">DAFTAR</h2>
          <h2 class="font-head text-[60px] text-[#FFA800] flex">DAPATKAN <img class="object-contain w-[30px]" src="{{asset('/images/acv.png')}}" />  60 Poin AWAL!</h2>
      </div>
      <div class="basis-full relative">
          <form>
            <div class="relative z-0 mb-6 w-full group">
                  <label for="password" class="block mb-2 text-sm font-medium text-[#A0A0A0] dark:text-gray-300">EMAIL ADDRESS</label>
                  <input type="email" name="floating_email" class="font-sans block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2  focus:outline-none focus:ring-0 focus:border-black-600 peer" placeholder="name@example.com" required="">
            </div>
            <div class="relative z-0 mb-6 w-full group">
                  <label for="password" class="block mb-2 text-sm font-medium text-[#A0A0A0] dark:text-gray-300">PASSWORD</label>
                  <input type="password" name="floating_password" class="font-sans block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 focus:outline-none focus:ring-0 focus:border-black-600 peer" placeholder="Password" required="">
            </div>
            <button type="submit" class="bg-gray-200 text-gray-600 p-4 w-full font-sans">KIRIM</button>
          </form>
          <div class="absolute right-[-15%] top-[50%] translate-y-[-50%]">OR</div>
      </div>
  </div>
  <div class="pt-8">
      <img alt="logo extra joss" class="m-auto" src="{{asset('/images/logo.png')}}"/>
  </div>
</div>