@extends('web/components/layout.index')
@section('meta-tag')
<title></title>
<meta name="description" content="meta description">
@endsection
@section('header')
@endsection
@section('main')
<main>
    <div class="modal-login w-full left-0 bg-[#FFEC00] px-9 lg:px-14 pt-9 lg:pt-20">
        <div class="bg-white flex flex-wrap py-14 px-4 lg:px-20 relative justify-between">
            <div class="close-login absolute top-[-22px] right-[-22px] rigth lg:top-[35px] lg:right-[35px] cursor-pointer                       ">
                <a href="{{route('home')}}" class="w-[44px] h-[44px] bg-black rounded-full flex items-center justify-center">
                    <img src="{{asset('/images/close-w.png')}}" />
                </a>
            </div>
            <div class="basis-full">
                <h2 class="font-head text-[60px]">MASUK</h2>
            </div>
            <div class="basis-full lg:basis-[48%] relative">
                <form method="POST" action="{{ route('login') }}">
                @csrf
                  <div class="relative z-0 mb-6 w-full group">
                        <label for="email" class="block mb-2 text-sm font-medium text-[#A0A0A0] dark:text-gray-300">USERNAME / EMAIL </label>
                        <input type="email" name="email" class="font-sans block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2  focus:outline-none focus:ring-0 focus:border-black-600 peer" placeholder="name@example.com or username" required value="{{ old('email') }}">
                        @if($message = Session::get('error_email'))
                        <div class="p-4 mt-4 text-[12px] text-red-700 bg-red-100  dark:bg-red-200 dark:text-red-800" role="alert">
                            <span class="font-medium">{{$message}}</span>
                        </div>
                    @endif
                  </div>
                  <div class="relative z-0 mb-6 w-full group">
                        <label for="password" class="block mb-2 text-sm font-medium text-[#A0A0A0] dark:text-gray-300">PASSWORD</label>
                        <input type="password" name="password" class="font-sans block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 focus:outline-none focus:ring-0 focus:border-black-600 peer" placeholder="Password" required >
                        @if($message = Session::get('error_password'))
                        <div class="p-4 mt-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                            <span class="font-medium">{{$message}}</span>
                        </div>
                    @endif
                  </div>
                  <button type="submit" class="bg-gray-200 text-gray-600 p-4 w-full font-sans">LOG IN</button>
                </form>
                <div class="absolute right-[-15%] top-[50%] translate-y-[-50%] hidden lg:block">OR</div>

               

                <div class="flex mt-4 justify-center">
                   <p class="font-sans mr-2">Belum punya akun? </p>
                   <a href={{route('daftar')}} class="font-sans text-blue-700">Daftar sekarang</a>
                </div>
                 @if (Route::has('password.request'))
                    <div class="flex mt-4 justify-center">
                        <a href={{ route('password.request.custom') }} class="font-sans text-blue-700">{{ __('Lupa Password ?') }}</a>
                    </div>
                 @endif

            </div>
            <div class="basis-full lg:basis-[48%]">
                <span class="block font-sans text-center mb-5 text-[#A0A0A0]"> atau login dengan </span>
                <a href="{{ url('login/google') }}" class="flex items-center w-full lg:w-[65%] border-black border-2 py-4 px-6 m-auto mb-4 font-sans font-black text-[14px] lg:text-[16px]"><img width="26px" alt="google logo" class="mr-4 lg:mr-16" src="{{asset('images/google.png')}}"/>Continue With Google</a>
                {{-- <a href="{{ url('/login/facebook') }}" class="flex items-center w-full lg:w-[65%] border-black border-2 py-4 px-6 m-auto font-sans font-black text-[14px] lg:text-[16px]"><img width="26px" alt="fb logo" class="mr-4 lg:mr-16" src="{{asset('images/facebook.png')}}"/>Continue With Facebook</a> --}}
            </div>
        </div>
        <div class="pb-14 pt-10">
            <img alt="logo extra joss" class="m-auto mb-2" src="{{asset('/images/logo.png')}}"/>
            <p class="font-sans text-center text-[10px]">Copyright © 2022 ExtraJoss</p>
        </div>
    </div>
</main>
@endsection