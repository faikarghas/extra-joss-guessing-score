@extends('web/components/layout.index')
@section('meta-tag')
<title></title>
<meta name="description" content="meta description">
@endsection
@section('header')
    <header class="relative">
        <img src="{{asset('/images/bg-lap.png')}}" class="w-full h-full"/>

        @include('web.components.presentational.nav') 

        <section class="lg:absolute lg:w-[95%] lg:left-[50%] lg:translate-x-[-50%] lg:top-[58%] lg:translate-y-[-50%]">
            <div class="bg-[#FCF006] lg:bg-[#F8F8F8] px-12 pt-28 pb-28 flex flex-col items-center justify-center">
                <h1 class="text-black text-[60px] font-head mb-8 leading-tight">TEMUKAN KAMI DI MARKET PLACE</h1>
                <div class="flex flex-col lg:flex-row justify-center gap-12 w-full">
                    <a class="bg-white w-[100%] lg:w-[244px] h-[192px] rounded-full rounded-[2rem] lg:rounded-3xl p-4 flex flex-row lg:flex-col justify-center items-center shadow-[7px_10px_18px_rgba(0,0,0,0.25)]">
                        <div class="w-[180px] flex flex-row lg:flex-col justify-left items-center">
                            <img
                            alt="image-femmy"
                            class="w-[60px] h-[59px] object-contain mb-3 mr-4 lg:mr-0"
                            src="/images/tokped-logo.png"
                            />
                            <span class="font-sans text-femmy-pdark">Tokopedia</span>
                        </div>
                    </a>
                    <a class="bg-white w-[100%] lg:w-[244px] h-[192px] rounded-full rounded-[2rem] lg:rounded-3xl p-4 flex flex-row lg:flex-col justify-center items-center shadow-[7px_10px_18px_rgba(0,0,0,0.25)]">
                        <div class="w-[180px] flex flex-row lg:flex-col justify-left items-center">
                            <img
                            alt="image-femmy"
                            class="w-[60px] h-[59px] object-contain mb-3 mr-4 lg:mr-0"
                            src="/images/lazadaa.png"
                            />
                            <span class="font-sans text-femmy-pdark">Lazada</span>
                        </div>
                    </a>
                    <a class="bg-white w-[100%] lg:w-[244px] h-[192px] rounded-full rounded-[2rem] lg:rounded-3xl p-4 flex flex-row lg:flex-col justify-center items-center shadow-[7px_10px_18px_rgba(0,0,0,0.25)]">
                        <div class="w-[180px] flex flex-row lg:flex-col justify-left items-center">
                            <img
                            alt="image-femmy"
                            class="w-[60px] h-[59px] object-contain mb-3 mr-4 lg:mr-0"
                            src="/images/shopee-logo.png"
                            />
                            <span class="font-sans text-femmy-pdark">Shopee</span>
                        </div>
                    </a>
                    <a class="bg-white w-[100%] lg:w-[244px] h-[192px] rounded-full rounded-[2rem] lg:rounded-3xl p-4 flex flex-row lg:flex-col justify-center items-center shadow-[7px_10px_18px_rgba(0,0,0,0.25)]">
                        <div class="w-[180px] flex flex-row lg:flex-col justify-left items-center">
                            <img
                            alt="image-femmy"
                            class="w-[60px] h-[59px] object-contain mb-3 mr-4 lg:mr-0"
                            src="/images/tiktok-logo.png"
                            />
                            <span class="font-sans text-femmy-pdark">Tik Tok Shop</span>
                        </div>
                    </a>
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