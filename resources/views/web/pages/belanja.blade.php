@extends('web/components/layout.index')
@section('meta-tag')
<title></title>
<meta name="description" content="meta description">
@endsection
@section('header')
    <header class="relative info bg-no-repeat bg-cover" style="background-image: url({{asset('/images/bg-lap.png')}})">
        @include('web.components.presentational.nav') 
        {{-- <section class="lg:absolute lg:w-[95%] lg:left-[50%] lg:translate-x-[-50%] lg:top-[58%] lg:translate-y-[-50%]"> --}}
        <section class="lg:relative lg:w-[95%] lg:left-[50%] lg:translate-x-[-50%] pt-[85px] sm:pt-[130px] lg:pt-[160px]">
            <div class="bg-[#FCF006] lg:bg-[#F8F8F8] px-12 pt-28 pb-28 flex flex-col items-center justify-center">
                <h1 class="text-black text-[60px] font-head mb-8 leading-tight">TEMUKAN KAMI DI MARKET PLACE</h1>
                <div class="flex flex-col lg:flex-row justify-center gap-12 w-full">
                    <a href="https://www.tokopedia.com/b7official/etalase/extra-joss?utm_source=website&utm_medium=brand&utm_campaign=_eta_ej_web_031112_311222" target="_blank" rel="noopener" class="bg-white w-[100%] lg:w-[244px] h-[192px] rounded-full rounded-[2rem] lg:rounded-3xl p-4 flex flex-row lg:flex-col justify-center items-center shadow-[7px_10px_18px_rgba(0,0,0,0.25)]">
                        <div class="w-[180px] flex flex-row lg:flex-col justify-left items-center">
                            <img
                            alt="image-femmy"
                            class="w-[60px] h-[59px] object-contain mb-3 mr-4 lg:mr-0"
                            src="/images/tokped-logo.png"
                            />
                            <span class="font-sans text-femmy-pdark">Tokopedia</span>
                        </div>
                    </a>
                    <a href="https://www.lazada.co.id/shop/bintang-toedjoe-official-store?path=index.htm&lang=id&pageTypeId=1" target="_blank" rel="noopener" class="bg-white w-[100%] lg:w-[244px] h-[192px] rounded-full rounded-[2rem] lg:rounded-3xl p-4 flex flex-row lg:flex-col justify-center items-center shadow-[7px_10px_18px_rgba(0,0,0,0.25)]">
                        <div class="w-[180px] flex flex-row lg:flex-col justify-left items-center">
                            <img
                            alt="image-femmy"
                            class="w-[60px] h-[59px] object-contain mb-3 mr-4 lg:mr-0"
                            src="/images/lazadaa.png"
                            />
                            <span class="font-sans text-femmy-pdark">Lazada</span>
                        </div>
                    </a>
                    <a href="https://shopee.co.id/universal-link/bintangtoedjoe_officialstore?shopCollection=39397425&deep_and_web=1&utm_campaign=s156508041_ss_id_ig00_etalaseej&utm_source=instagram&utm_medium=seller&utm_content=&smtt=9#product_list" target="_blank" rel="noopener" class="bg-white w-[100%] lg:w-[244px] h-[192px] rounded-full rounded-[2rem] lg:rounded-3xl p-4 flex flex-row lg:flex-col justify-center items-center shadow-[7px_10px_18px_rgba(0,0,0,0.25)]">
                        <div class="w-[180px] flex flex-row lg:flex-col justify-left items-center">
                            <img
                            alt="image-femmy"
                            class="w-[60px] h-[59px] object-contain mb-3 mr-4 lg:mr-0"
                            src="/images/shopee-logo.png"
                            />
                            <span class="font-sans text-femmy-pdark">Shopee</span>
                        </div>
                    </a>
                    <a href="https://www.tiktok.com/@generasibejo?_t=8XGLsVCqmjR&_r=1" target="_blank" rel="noopener" class="bg-white w-[100%] lg:w-[244px] h-[192px] rounded-full rounded-[2rem] lg:rounded-3xl p-4 flex flex-row lg:flex-col justify-center items-center shadow-[7px_10px_18px_rgba(0,0,0,0.25)]">
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

            <div class="pt-14 pb-8">
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