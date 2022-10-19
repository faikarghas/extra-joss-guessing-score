@extends('web/components/layout.index')
@section('meta-tag')
<title></title>
<meta name="description" content="meta description">
@endsection
@section('header')
@endsection
@section('main')
<main>
    <div class="modal-login w-full fixed top-0 left-0 bg-[#FFEC00] px-14 py-20">
        <div class="bg-white flex flex-wrap py-14 px-20 relative justify-between">
            <div class="close-login absolute top-[35px] right-[35px] cursor-pointer                       ">
                <a href="{{route('ex')}}" class="w-[44px] h-[44px] bg-black rounded-full flex items-center justify-center">
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
                        <label for="email" class="block mb-2 text-sm font-medium text-[#A0A0A0] dark:text-gray-300">EMAIL ADDRESS</label>
                        <input type="email" name="email" class="font-sans block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2  focus:outline-none focus:ring-0 focus:border-black-600 peer" placeholder="name@example.com" required>
                  </div>
                  <div class="relative z-0 mb-6 w-full group">
                        <label for="password" class="block mb-2 text-sm font-medium text-[#A0A0A0] dark:text-gray-300">PASSWORD</label>
                        <input type="password" name="password" class="font-sans block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 focus:outline-none focus:ring-0 focus:border-black-600 peer" placeholder="Password" required="">
                  </div>
                  <button type="submit" class="bg-gray-200 text-gray-600 p-4 w-full font-sans">LOG IN</button>
                </form>
                <div class="absolute right-[-15%] top-[50%] translate-y-[-50%] ">OR</div>
            </div>
            <div class="basis-full lg:basis-[48%]">
                <span class="block font-sans text-center mb-5 text-[#A0A0A0]"> atau login dengan </span>
                <a href="{{ url('login/google') }}" class="flex items-center w-full lg:w-[65%] border-black border-2 py-4 px-6 m-auto mb-4 font-sans font-black"><img width="26px" alt="google logo" class="mr-16" src="{{asset('images/google.png')}}"/>Continue With Google</a>
    
                <a href="{{ url('/login/facebook') }}" class="flex items-center w-full lg:w-[65%] border-black border-2 py-4 px-6 m-auto font-sans font-black"><img width="26px" alt="fb logo" class="mr-16" src="{{asset('images/facebook.png')}}"/>Continue With Facebook</a>
            </div>
        </div>
        <div class="pt-8">
            <img alt="logo extra joss" class="m-auto mb-2" src="{{asset('/images/logo.png')}}"/>
            <p class="font-sans text-center text-[10px]">Copyright © 2022 ExtraJoss</p>
        </div>
    </div>
</main>
@endsection