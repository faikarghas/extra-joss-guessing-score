@extends('web/components/layout.index')
@section('meta-tag')
<title></title>
<meta name="description" content="meta description">
@endsection
@section('header')
@endsection
@section('main')
<main>
    <div class="modal-login w-full h-screen left-0 bg-[#FFEC00] px-9 lg:px-14 pt-9 lg:pt-20">
        <div class="bg-white flex flex-wrap py-14 px-4 lg:px-20 relative justify-between">
            <div class="close-login absolute top-[-22px] right-[-22px] rigth lg:top-[35px] lg:right-[35px] cursor-pointer                       ">
                <a href="{{route('home')}}" class="w-[44px] h-[44px] bg-black rounded-full flex items-center justify-center">
                    <img src="{{asset('/images/close-w.png')}}" />
                </a>
            </div>
            <div class="basis-full">
                <h2 class="font-head text-[60px]">RESET PASSWORD</h2>
            </div>
            <div class="basis-full lg:basis-[100%] relative">
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <form method="POST" action="{{ route('reset.password.post') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                  <div class="relative z-0 mb-6 w-full group">
                        <label for="email" class="block mb-2 text-sm font-medium text-[#A0A0A0] dark:text-gray-300">EMAIL ADDRESS</label>
                        <input type="email" name="email" id="email" class="font-sans block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2  focus:outline-none focus:ring-0 focus:border-black-600 peer" value="{{request()->get('email')}}"  disabled>
                  </div>
                  <div class="relative z-0 mb-6 w-full group">
                    <label for="email" class="block mb-2 text-sm font-medium text-[#A0A0A0] dark:text-gray-300">PASSWORD</label>
                    <input type="password" name="password" id="password" class="font-sans block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2  focus:outline-none focus:ring-0 focus:border-black-600 peer" required  autofocus>
                    
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                  </div>
                  <div class="relative z-0 mb-6 w-full group">
                    <label for="email" class="block mb-2 text-sm font-medium text-[#A0A0A0] dark:text-gray-300">CONFIRM PASSWORD</label>
                    <input type="password" name="password_confirmation" id="password-confirm" class="font-sans block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2  focus:outline-none focus:ring-0 focus:border-black-600 peer" required autocomplete="new-password">
                  </div>

                  <button type="submit" class="bg-gray-200 text-gray-600 p-4 w-full font-sans">  {{ __('RESET PASSWORD') }}</button>
                </form>





            </div>

        </div>
        <div class="pb-14 pt-10">
            <img alt="logo extra joss" class="m-auto mb-2" src="{{asset('/images/logo.png')}}"/>
            <p class="font-sans text-center text-[10px]">Copyright © 2022 ExtraJoss</p>
        </div>
    </div>
</main>
@endsection