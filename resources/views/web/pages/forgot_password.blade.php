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
                <h2 class="font-head text-[60px]">LUPA PASSWORD</h2>
            </div>
            <div class="basis-full lg:basis-[100%] relative">
                <form method="POST" action="{{ route('login') }}">
                @csrf
                  <div class="relative z-0 mb-6 w-full group">
                        <label for="email" class="block mb-2 text-sm font-medium text-[#A0A0A0] dark:text-gray-300">EMAIL ADDRESS</label>
                        <input type="email" name="email" class="font-sans block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2  focus:outline-none focus:ring-0 focus:border-black-600 peer" placeholder="name@example.com" required value="{{ old('email') }}">
                        @if($message = Session::get('error_email'))
                        <div class="p-4 mt-4 text-[12px] text-red-700 bg-red-100  dark:bg-red-200 dark:text-red-800" role="alert">
                            <span class="font-medium">{{$message}}</span>
                        </div>
                    @endif
                  </div>
                  
                  <button type="submit" class="bg-gray-200 text-gray-600 p-4 w-full font-sans">SEND</button>
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