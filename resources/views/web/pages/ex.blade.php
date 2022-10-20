@extends('web/components/layout.index')
@section('meta-tag')
<title></title>
<meta name="description" content="meta description">
@endsection
@section('header')
    <header class="relative">
        <img src="{{asset('/images/banner.png')}}" class="w-full h-full"/>

        @include('web.components.presentational.nav') 

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

            <div class="tebak-quiz hidden xl:flex items-center flex-col mb-20">
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
                @auth
                @foreach ($myguess as $key => $match)
                    @if ($key < 8)
                    <div class="basis-full lg:basis-1/2 border-b-[1px] border-r-[1px] border-[#383838] px-4 py-6">
                        <span class="block mb-2.5 text-[16px] font-sans text-[#acacac]">Group {{$match->group}} • {{$match->match_time}}</span>
                        <div class="flex flex-wrap">
                            <ul class="basis-1/2 border-r-[1px] border-[#383838]">
                                <li class="mb-2 flex items-center">
                                    <img src="{{asset('/images/countries')}}/{{$match->flag_team1}}" class="h-[30px]"/>
                                    <p class="text-white font-sans ml-1.5 text-[15px] leading-tight">{{$match->team1}}</p>
                                </li>
                                <li class="flex items-center">
                                    <img src="{{asset('/images/countries')}}/{{$match->flag_team2}}" class="h-[30px]"/>
                                    <p class="text-white font-sans ml-1.5 text-[15px] leading-tight">{{$match->team2}}</p>
                                </li>
                            </ul>
                            <div class="basis-1/2 flex items-center justify-center">
                                <?php
                                    $datetime = date($match->match_time);
                                    $timestamp = strtotime($datetime);
                                    $time = $timestamp - (1 * 60 * 60);
                                    $datetime = date("Y-m-d H:i:s", $time);

                                    $d1 = new DateTime($currentTime);
                                    $d2 = new DateTime($datetime);
                                ?>
                                @if ($d1 < $d2)
                                    {{-- belum expire --}}
                                    @if ($match->is_guess == 0)
                                    {{-- belum tebak skor --}}
                                    {{$match->is_guess}}
                                    <div data-idMatch={{$match->id_match}} data-flag1={{$match->flag_team1}} data-flag2={{$match->flag_team2}} data-team1={{$match->team1}} data-team2={{$match->team2}} class="btn-tebak bg-[#FF0000] text-white text-[12px] rounded-2xl py-1 px-2 w-[100px] text-center cursor-pointer">Tebak Skor</div>
                                    @else
                                    {{-- sudah tebak skor --}}
                                    <ul class="score">
                                        <li class="flex items-center">
                                            <p class="text-white font-sans mr-4 text-[22px] font-bold leading-tight">{{$match->guessing_score_a}}</p>
                                        </li>
                                        <li class="flex items-center">
                                            <p class="text-white font-sans mr-4 text-[22px] font-bold leading-tight">{{$match->guessing_score_b}}</p>
                                        </li>
                                    </ul>
                                    <div data-idMatch={{$match->id_match}} data-skor="{{$match->guessing_score_a}},{{$match->guessing_score_b}}" data-flag1={{$match->flag_team1}} data-flag2={{$match->flag_team2}} data-team1={{$match->team1}} data-team2={{$match->team2}} class="btn-tebak cursor-pointer bg-[#0085CF] text-white text-[12px] rounded-2xl py-1 px-2 w-[94px] text-center">Edit Skor</div>
                                    @endif
                                @else
                                    @if ($match->is_guess == 1)
                                        {{-- sudah expire dan sudah tebak skor --}}
                                        <ul class="score">
                                            <li class="flex items-center">
                                                <p class="text-[#6D6D6D] font-sans mr-4 text-[22px] font-bold leading-tight">{{$match->guessing_score_a}}</p>
                                            </li>
                                            <li class="flex items-center">
                                                <p class="text-[#6D6D6D] font-sans mr-4 text-[22px] font-bold leading-tight">{{$match->guessing_score_b}}</p>
                                            </li>
                                        </ul>
                                        <div class="bg-[#6D6D6D] text-white text-[12px] rounded-2xl py-1 px-2 w-[94px] text-center">Edit Skor</div>
                                    @else
                                        {{-- sudah expire dan belum tebak skor --}}
                                        <ul class="score">
                                            <li class="flex items-center">
                                                <p class="text-[#6D6D6D] font-sans ml-4 text-[22px] font-bold leading-tight">0</p>
                                            </li>
                                            <li class="flex items-center">
                                                <p class="text-[#6D6D6D] font-sans ml-4 text-[22px] font-bold leading-tight">0</p>
                                            </li>
                                        </ul>
                                        <div class="flex items-center ml-4">
                                            <img src="{{asset('images/acvgrey.png')}}" class="h-[35px]"/>
                                            <div>
                                                <span class="block font-sans text-[10px] text-[#6D6D6D]">Anda dapat</span>
                                                <span class="block font-sans text-[12px] font-bold text-[#6D6D6D]">0 Poin</span>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
                @else
                    @foreach ($matches as $key => $match)
                        @if ($key < 8)
                        <div class="basis-full lg:basis-1/2 border-b-[1px] border-r-[1px] border-[#383838] px-4 py-6">
                            <span class="block mb-2.5 text-[16px] font-sans text-[#acacac]">Group {{$match->group}} • {{$match->match_time}}</span>
                            <div class="flex flex-wrap">
                                <ul class="basis-1/2 border-r-[1px] border-[#383838]">
                                    <li class="mb-2 flex items-center">
                                        <img src="{{asset('/images/countries')}}/{{$match->flag_team1}}" class="h-[30px]"/>
                                        <p class="text-white font-sans ml-1.5 text-[15px] leading-tight">{{$match->team1}}</p>
                                    </li>
                                    <li class="flex items-center">
                                        <img src="{{asset('/images/countries')}}/{{$match->flag_team2}}" class="h-[30px]"/>
                                        <p class="text-white font-sans ml-1.5 text-[15px] leading-tight">{{$match->team2}}</p>
                                    </li>
                                </ul>
                                <div class="basis-1/2 flex items-center justify-center">
                                    <a href="{{route('masuk')}}" class="bg-[#FF0000] text-white text-[12px] rounded-2xl py-1 px-2 w-[100px] text-center cursor-pointer">Tebak Skor</a>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                @endauth
            </div>
            <div class="basis-full lg:basis-1/2 flex flex-wrap bg-[#202124]">
                @auth
                @foreach ($myguess as $key => $match)
                    @if ($key < 8)
                    <div class="basis-full lg:basis-1/2 border-b-[1px] border-r-[1px] border-[#383838] px-4 py-6">
                        <span class="block mb-2.5 text-[16px] font-sans text-[#acacac]">Group {{$match->group}} • {{$match->match_time}}</span>
                        <div class="flex flex-wrap">
                            <ul class="basis-1/2 border-r-[1px] border-[#383838]">
                                <li class="mb-2 flex items-center">
                                    <img src="{{asset('/images/countries')}}/{{$match->flag_team1}}" class="h-[30px]"/>
                                    <p class="text-white font-sans ml-1.5 text-[15px] leading-tight">{{$match->team1}}</p>
                                </li>
                                <li class="flex items-center">
                                    <img src="{{asset('/images/countries')}}/{{$match->flag_team2}}" class="h-[30px]"/>
                                    <p class="text-white font-sans ml-1.5 text-[15px] leading-tight">{{$match->team2}}</p>
                                </li>
                            </ul>
                            <div class="basis-1/2 flex items-center justify-center">
                                <?php
                                    $datetime = date($match->match_time);
                                    $timestamp = strtotime($datetime);
                                    $time = $timestamp - (1 * 60 * 60);
                                    $datetime = date("Y-m-d H:i:s", $time);

                                    $d1 = new DateTime($currentTime);
                                    $d2 = new DateTime($datetime);
                                ?>
                                @if ($d1 < $d2)
                                    {{-- belum expire --}}
                                    @if ($match->is_guess == 0)
                                    {{-- belum tebak skor --}}
                                    {{$match->is_guess}}
                                    <div data-idMatch={{$match->id_match}} data-flag1={{$match->flag_team1}} data-flag2={{$match->flag_team2}} data-team1={{$match->team1}} data-team2={{$match->team2}} class="btn-tebak bg-[#FF0000] text-white text-[12px] rounded-2xl py-1 px-2 w-[100px] text-center cursor-pointer">Tebak Skor</div>
                                    @else
                                    {{-- sudah tebak skor --}}
                                    <ul class="score">
                                        <li class="flex items-center">
                                            <p class="text-white font-sans mr-4 text-[22px] font-bold leading-tight">{{$match->guessing_score_a}}</p>
                                        </li>
                                        <li class="flex items-center">
                                            <p class="text-white font-sans mr-4 text-[22px] font-bold leading-tight">{{$match->guessing_score_b}}</p>
                                        </li>
                                    </ul>
                                    <div data-idMatch={{$match->id_match}} data-skor="{{$match->guessing_score_a}},{{$match->guessing_score_b}}" data-flag1={{$match->flag_team1}} data-flag2={{$match->flag_team2}} data-team1={{$match->team1}} data-team2={{$match->team2}} class="btn-tebak cursor-pointer bg-[#0085CF] text-white text-[12px] rounded-2xl py-1 px-2 w-[94px] text-center">Edit Skor</div>
                                    @endif
                                @else
                                    @if ($match->is_guess == 1)
                                        {{-- sudah expire dan sudah tebak skor --}}
                                        <ul class="score">
                                            <li class="flex items-center">
                                                <p class="text-[#6D6D6D] font-sans mr-4 text-[22px] font-bold leading-tight">{{$match->guessing_score_a}}</p>
                                            </li>
                                            <li class="flex items-center">
                                                <p class="text-[#6D6D6D] font-sans mr-4 text-[22px] font-bold leading-tight">{{$match->guessing_score_b}}</p>
                                            </li>
                                        </ul>
                                        <div class="bg-[#6D6D6D] text-white text-[12px] rounded-2xl py-1 px-2 w-[94px] text-center">Edit Skor</div>
                                    @else
                                        {{-- sudah expire dan belum tebak skor --}}
                                        <ul class="score">
                                            <li class="flex items-center">
                                                <p class="text-[#6D6D6D] font-sans ml-4 text-[22px] font-bold leading-tight">0</p>
                                            </li>
                                            <li class="flex items-center">
                                                <p class="text-[#6D6D6D] font-sans ml-4 text-[22px] font-bold leading-tight">0</p>
                                            </li>
                                        </ul>
                                        <div class="flex items-center ml-4">
                                            <img src="{{asset('images/acvgrey.png')}}" class="h-[35px]"/>
                                            <div>
                                                <span class="block font-sans text-[10px] text-[#6D6D6D]">Anda dapat</span>
                                                <span class="block font-sans text-[12px] font-bold text-[#6D6D6D]">0 Poin</span>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
                @else
                    @foreach ($matches as $key => $match)
                        @if ($key < 8)
                        <div class="basis-full lg:basis-1/2 border-b-[1px] border-r-[1px] border-[#383838] px-4 py-6">
                            <span class="block mb-2.5 text-[16px] font-sans text-[#acacac]">Group {{$match->group}} • {{$match->match_time}}</span>
                            <div class="flex flex-wrap">
                                <ul class="basis-1/2 border-r-[1px] border-[#383838]">
                                    <li class="mb-2 flex items-center">
                                        <img src="{{asset('/images/countries')}}/{{$match->flag_team1}}" class="h-[30px]"/>
                                        <p class="text-white font-sans ml-1.5 text-[15px] leading-tight">{{$match->team1}}</p>
                                    </li>
                                    <li class="flex items-center">
                                        <img src="{{asset('/images/countries')}}/{{$match->flag_team2}}" class="h-[30px]"/>
                                        <p class="text-white font-sans ml-1.5 text-[15px] leading-tight">{{$match->team2}}</p>
                                    </li>
                                </ul>
                                <div class="basis-1/2 flex items-center justify-center">
                                    <a href="{{route('masuk')}}" class="bg-[#FF0000] text-white text-[12px] rounded-2xl py-1 px-2 w-[100px] text-center cursor-pointer">Tebak Skor</a>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                @endauth
            </div>
        </div>
    </section>
    <section class="relative bg-[#FFEC00] px-8 pt-6">
        <div class="bg-[#F8F8F8] p-10">
            <div class="flex flex-col">
                <h2 class="text-black font-head text-[60px] leading-[50px] mb-4 m-auto inline-block m-auto">LEADERBOARD</h2>
                <h5 class="text-black font-head text-[20px] m-auto inline-block m-auto">STATISTIK ANDA<h5>
            </div>
            <div class="flex flex-row justify-center pt-4 pb-8 gap-12 items-center">
                <ul class="flex flex-col justify-center items-center w-[180px]">
                    <li class="text-black text-[36px] leading-[26px] font-sans font-bold">
                        @auth
                        242
                        @else
                        0
                        @endauth
                    </li>
                    <li class="text-[#A0A0A0] text-[20px] font-sans">Ranking</li>
                </ul>
                <ul class="flex flex-col justify-center items-center">
                    <li class="uppercase text-black text-[16px] bg-[#FFEC00] p-2 leading-[26px] font-sans font-bold w-[63px] h-[63px] rounded-full flex justify-center items-center mb-2">
                        @auth
                        <?php
                            $str = Auth::user()->name;
                            $words = explode(' ', $str);
                            $userInitial = $words[0][0]. $words[1][0]
                        ?>
                        {{$userInitial}}
                        @endauth
                    </li>
                    <li class="text-black text-[16px] font-sans font-bold">
                        @auth
                        {{ Auth::user()->name }}
                        @endauth
                    </li>
                </ul>
                <ul class="flex flex-col justify-center items-center w-[180px]">
                    <li class="text-black text-[36px] leading-[26px] font-sans font-bold">
                        @auth
                        242
                        @else
                        0
                        @endauth
                    </li>
                    <li class="text-[#A0A0A0] text-[20px] font-sans">Points</li>
                </ul>
            </div>
            <div class="grid grid-cols-4 gap-4 p-8">
                @foreach ($klasemens as $key => $klasemen)
                    <div class="flex items-center">
                        <span class="block font-sans font-bold text-[17px] mr-2 w-[40px]">{{$key + 1}}</span>
                        <div class="w-[80px]">
                            <div class="w-[60px] h-[60px] bg-[#D6D6D8] rounded-full flex justify-center items-center mr-4">
                                <?php
                                    $str = $klasemen->name;
                                    $words = explode(' ', $str);
                                    $userInitials = $words[0][0]. $words[1][0]
                                ?>
                            {{$userInitials}}
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <span class="block font-sans font-bold text-[17px]">{{$klasemen->name}}</span>
                            <span class="block font-sans ">{{$klasemen->total_point}} points</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <div class="pb-14 pt-10 bg-[#FFEC00]">
        <img alt="logo extra joss" class="m-auto mb-2" src="{{asset('/images/logo.png')}}"/>
        <p class="font-sans text-center text-[10px]">Copyright © 2022 ExtraJoss</p>
    </div>

    {{-- MODAL TEBAK SKOR --}}
    <div class="modal-form hidden flex-wrap bg-black w-[400px] md:w-[600px] p-14 fixed top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%]"></div>

    {{-- MODAL QUIZ --}}
    @include('web.components.modal.quiz')

</main>
@endsection