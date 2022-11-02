@extends('web/components/layout.index')
@section('meta-tag')
<title></title>
<meta name="description" content="meta description">
@endsection
@section('header')
    <div class="relative h-full">
    <header class="relative  info bg-no-repeat bg-cover bg-[#FFEC00]" >
        @include('web.components.presentational.nav') 
        <section class="relative z-20 m-auto lg:w-[95%] pt-[85px] sm:pt-[130px] lg:pt-[160px]">
            <div class="bg-[#FCF006] lg:bg-[#F8F8F8] px-12 pt-8 pb-28 flex flex-col">
                <h1 class="text-black text-[60px] font-head mb-8 leading-[50px]">MEKANISME</h1>
                <div class="flex flex-col content">
                  {!!$mekanisme[0]->content!!}
                </div>
            </div>

            <div class="pt-14 pb-8">
                <img alt="logo extra joss" class="m-auto mb-2" src="{{asset('/images/logo.png')}}"/>
                <p class="font-sans text-center text-[10px]">Copyright © 2022 ExtraJoss</p>
            </div>
        </section>
    </header>
    <div class="h-[1300px] z-10 absolute bottom-0">
        <img class="w-full object-cover h-full" src="{{asset('/images/bg-lap.png')}}"/>
    </div>
    <div>
@endsection
@section('main')
<main>

</main>
@endsection