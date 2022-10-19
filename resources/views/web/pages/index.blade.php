@extends('web/components/layout.index')
@section('meta-tag')
<title></title>
<meta name="description" content="meta description">
@endsection
@section('header')
    <header class="relative">
        <img src="{{asset('/images/banner.png')}}" class="w-full h-full"/>

        <nav class="absolute w-full top-0 left-0 bg-transparent px-2 xl:px-[128px] pt-[25px]">
            <div class="container flex flex-wrap justify-between items-center mx-auto">
            <a href="https://flowbite.com/" class="flex items-center">
                <img src="{{asset('/images/logo.png')}}" class="mr-3 h-6 sm:h-[98px]" alt="Flowbite Logo">
            </a>
            <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
            </button>
            <div class="hidden w-full md:block md:w-auto pb-8" id="navbar-default">
                <ul class="flex flex-col px- md:flex-row md:space-x-4 md:mt-0 ">
                    <li class="flex items-center">
                        <a href="#" class="leading-[20px] block pr-4 pl-3 font-head text-[24px] text-[#FF0000]" aria-current="page">BERANDA</a>
                    </li>
                    <li class="flex items-center">
                        <a href="#" class="leading-[20px] block pr-4 pl-3 font-head text-[24px] text-[#FF0000]" aria-current="page">MEKANISME</a>
                    </li>
                    <li class="flex items-center">
                        <a href="#" class="leading-[20px] block pr-4 pl-3 font-head text-[24px] text-[#FF0000]" aria-current="page">HADIAH</a>
                    </li>
                    <li class="flex items-center">
                        <a href="#" class="leading-[20px] block pr-4 pl-3 font-head text-[24px] text-[#FF0000]" aria-current="page">BELANJA</a>
                    </li>
                    <li>
                        
                        <ul class="m-0 px-6 py-1 flex bg-black rounded-3xl">
                            @guest
                            <li class="log flex items-center list-none cursor-pointer">
                                <img alt="icon user" src="{{asset('images/user.png')}}" class="w-[14px] mr-2 pb-1"/>
                                <p class="font-head text-[#FFEC00] text-[20px] leading-[18px]">MASUK</p></li>
                            <li class="flex items-center list-none font-head text-[#FFEC00] text-[20px] mx-2">|</li>
                            <li class="reg flex items-center list-none cursor-pointer"><p class="font-head text-[#FFEC00] text-[20px] leading-[20px]">DAFTAR</p></li>
                            @endguest
                            @auth
                            <li class="flex items-center list-none cursor-pointer">
                                <img alt="icon user" src="{{asset('images/user.png')}}" class="w-[14px] mr-2 pb-1"/>
                                <p class="font-head text-[#FFEC00] text-[20px] leading-[18px]">{{ Auth::user()->name }}</p></li>
                            <li class="flex items-center list-none font-head text-[#FFEC00] text-[20px] mx-2">|</li>
                            <li class="flex items-center list-none cursor-pointer"><a href="{{ route('logout') }}" class="font-head text-[#FFEC00] text-[20px] leading-[20px]">LOGOUT</a></li>
                            @endauth

                        </ul>
                    </li>
                </ul>
            </div>
            </div>
        </nav>
    </header>
@endsection
@section('main')
<main>
    <section class="bg-black pt-4 xl:pt-20 pb-8 xl:pb-32 relative px-8 xl:h-[424px]">
        <div class="relative flex flex-col items-center xl:border-[4px] xl:border-[#383838] w-[90%] m-auto xl:pt-16">
            <div class="text-center xl:absolute bg-black xl:px-20 xl:top-[-40px] xl:h-[40px] xl:left-[50%] xl:translate-x-[-50%]">
                <h3 class="text-[40px] xl:text-[60px] text-white font-head">Hasil Terakhir</h3>
            </div>
            <div class="flex flex-wrap flex-row justify-center items-center gap-10 mb-4">
                <div class="">
                    <div class="text-center mb-8">
                        <span class="text-[#FFFFFF]">Final Score</span>
                    </div>
                    <div class="flex flex-wrap flex-row">
                        <div class="text-white flex flex-row">
                            <div class="text-center mr-6">
                                <div class="h-[50px] xl:h-[78px] mb-4">
                                    <img src="{{asset('/images/countries/equador.png')}}" class="h-[50px] md:h-[77px]"/>
                                </div>
                                <span class="font-sans text-[16px] font-bold">Ecuador</span>
                            </div>
                            <div class="">
                                <div class="h-[77px] flex items-center">
                                    <h6 class="text-[40px] md:text-[60px] font-sans leading-[45px]">0</h6>
                                </div>
                            </div>
                        </div>
                        <div class="text-white mx-2 xl:mx-4 md:mx-6">
                            <div class="h-[77px] flex items-center">
                                <span class="text-[17px] md:text-[25px] text-[#383838] font-sans font-bold">VS</span>
                            </div>
                        </div>
                        <div class="text-white flex flex-row">
                            <div class="">
                                <div class="h-[77px] flex items-center">
                                    <h6 class="text-[40px] md:text-[60px] font-sans leading-[45px]">0</h6>
                                </div>
                            </div>
                            <div class="text-center ml-6">
                                <div class="h-[50px] xl:h-[78px] mb-4">
                                    <img src="{{asset('/images/countries/qatar.png')}}" class="h-[50px] md:h-[77px]"/>
                                </div>
                                <span class="font-sans text-[16px] font-bold">Qatar</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- absolute bottom-[-12%] md:bottom-[-24%] left-[50%] translate-x-[-50%] --}}
            <img src="{{asset("/images/lap2.png")}}" class="w-[1000px] hidden xl:block"/>

            <div class="hidden xl:flex items-center flex-col mb-20">
                <h2 class="text-black font-head text-[60px] text-center mb-6">IKUT KICKOFF QUIZ UNTUK NAMBAH POIN!</h2>
                <div class="qz cursor-pointer bg-black py-1.5 rounded-2xl w-[249px] font-sans text-[14px] text-[#FCEF0A] text-center">Lihat Quiz</div>
            </div>
        </div>
    </section>
    <section class="relative xl:static bg-top bg-cover bg-no-repeat pt-[60px] xl:pt-[25rem] px-8" style="background-image: url(/images/bg-yellow.png)">
        <img src="{{asset("/images/lap2.png")}}" class="block xl:hidden object-contain h-[100px] w-[300px] absolute xl:relative top-[-40px] md:bottom-[-24%] left-[50%] translate-x-[-50%] xl:translate-x-0"/>

        <div class="flex xl:hidden items-center flex-col mb-20">
            <h2 class="text-black font-head leading-[35px] xl:leading-tight text-[40px] xl:text-[60px] text-center mb-6">IKUT KICKOFF QUIZ UNTUK NAMBAH POIN!</h2>
            <div class="qz bg-black py-1.5 rounded-2xl w-[249px] font-sans text-[14px] text-[#FCEF0A] text-center">Lihat Quiz</div>
        </div>
        <div class="mb-8">
            <h2 class="text-black font-head text-[60px] text-center mb-2 uppercase leading-[50px]">Tebak Skor</h2>
            <h5 class="text-black font-head text-[20px] text-center uppercase">MINGGU KE 1</h5>
        </div>
        {{-- TEBAK SCORE  --}}
        <div class="flex flex-row flex-wrap lg:flex-nowrap gap-2">
            <div class="basis-full lg:basis-1/2 flex flex-wrap bg-[#202124]">
                @foreach ($matches as $key => $match)
                @if ($key < 8)
                <div class="basis-full lg:basis-1/2 border-b-[1px] border-r-[1px] border-[#383838] px-4 py-6">
                    <span class="block mb-2.5 text-[16px] font-sans text-[#acacac]">{{$match->round}}</span>
                    <div class="flex flex-wrap">
                        <ul class="basis-1/2 border-r-[1px] border-[#383838]">
                            <li class="mb-2 flex items-center">
                                <img src="{{asset('/images/countries/qatar.png')}}" class="h-[20px] xl:h-[30px]"/>
                                <p class="text-white font-sans ml-4 text-[17px] leading-tight">{{$match->team1}}</p>
                            </li>
                            <li class="flex items-center">
                                <img src="{{asset('/images/countries/equador.png')}}" class="h-[20px] xl:h-[30px]"/>
                                <p class="text-white font-sans ml-4 text-[17px] leading-tight">{{$match->team2}}</p>
                            </li>
                        </ul>
                        <div class="basis-1/2 flex items-center justify-center">
                            {{-- SCORE --}}
                            {{-- <ul class="score">
                                <li class="mb-2 flex items-center">
                                    <p class="text-white font-sans ml-4 text-[22px] font-bold leading-tight">0</p>
                                </li>
                                <li class="flex items-center">
                                    <p class="text-white font-sans ml-4 text-[22px] font-bold leading-tight">0</p>
                                </li>
                            </ul> --}}
                            {{-- EDIT --}}
                            {{-- <div class="bg-[#0085CF] text-white text-[12px] rounded-2xl py-1 px-2 w-[94px] text-center">Edit Skor</div> --}}
                            {{-- TEBAK --}}
                            <div data-idMatch={{$match->id}} data-team1={{$match->team1}} data-team2={{$match->team2}} class="btn-tebak bg-[#FF0000] text-white text-[12px] rounded-2xl py-1 px-2 w-[113px] text-center cursor-pointer">Tebak Skor{{$match->id}}</div>
                            {{-- REWARD --}}
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
            <div class="basis-full lg:basis-1/2 flex flex-wrap bg-[#202124]">
                @foreach ($matches as $key => $match)
                @if ($key > 8)
                <div class="basis-full lg:basis-1/2 border-b-[1px] border-r-[1px] border-[#383838] px-4 py-6">
                    <span class="block mb-2.5 text-[16px] font-sans text-[#acacac]">{{$match->round}}</span>
                    <div class="flex flex-wrap">
                        <ul class="basis-1/2 border-r-[1px] border-[#383838]">
                            <li class="mb-2 flex items-center">
                                <img src="{{asset('/images/countries/qatar.png')}}" class="h-[30px]"/>
                                <p class="text-white font-sans ml-4 text-[17px] leading-tight">{{$match->team1}}</p>
                            </li>
                            <li class="flex items-center">
                                <img src="{{asset('/images/countries/equador.png')}}" class="h-[30px]"/>
                                <p class="text-white font-sans ml-4 text-[17px] leading-tight">{{$match->team2}}</p>
                            </li>
                        </ul>
                        <div class="basis-1/2 flex items-center justify-center">
                            {{-- SCORE --}}
                            {{-- <ul class="score">
                                <li class="mb-2 flex items-center">
                                    <p class="text-white font-sans ml-4 text-[22px] font-bold leading-tight">0</p>
                                </li>
                                <li class="flex items-center">
                                    <p class="text-white font-sans ml-4 text-[22px] font-bold leading-tight">0</p>
                                </li>
                            </ul> --}}
                            {{-- EDIT --}}
                            {{-- <div class="bg-[#0085CF] text-white text-[12px] rounded-2xl py-1 px-2 w-[94px] text-center">Edit Skor</div> --}}
                            {{-- TEBAK --}}
                            <div data-idMatch={{$match->id}} data-team1={{$match->team1}} data-team2={{$match->team2}} class="btn-tebak bg-[#FF0000] text-white text-[12px] rounded-2xl py-1 px-2 w-[113px] text-center cursor-pointer">Tebak Skor{{$match->id}}</div>

                            {{-- REWARD --}}
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </section>


    {{-- MODAL TEBAK SKOR --}}
    <div class="modal-form hidden flex-wrap bg-black w-[400px] md:w-[600px] p-14 fixed top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%]"></div>

    {{-- Modal --}}
    @include('web.components.modal.quiz')
    @include('web.components.modal.login')
    @include('web.components.modal.register') 
    {{-- Pages --}}
    
</main>
@endsection