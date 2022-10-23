@extends('web/components/layout.index')
@section('meta-tag')
<title></title>
<meta name="description" content="meta description">
@endsection
@section('header')
    <header class="relative info bg-no-repeat bg-cover" style="background-image: url({{asset('/images/bg-lap.png')}})">
        @include('web.components.presentational.nav') 
        <section class="lg:relative lg:w-[95%] lg:left-[50%] lg:translate-x-[-50%] pt-[85px] sm:pt-[130px] lg:pt-[160px]">
            <div class="bg-[#FCF006] lg:bg-[#F8F8F8] px-12 pt-8 pb-28 flex flex-col">
                <h1 class="text-black text-[60px] font-head mb-8 leading-[50px]">HADIAH</h1>
                <div class="flex flex-col content">
                  {!!$hadiah[0]->content!!}
                </div>
            </div>

            <div class="pt-14">
                <img alt="logo extra joss" class="m-auto mb-2" src="{{asset('/images/logo.png')}}"/>
                <p class="font-sans text-center text-[10px]">Copyright © 2022 ExtraJoss</p>
            </div>
        </section>
    </header>
@endsection
@section('main')
<main>

</main>
@endsection