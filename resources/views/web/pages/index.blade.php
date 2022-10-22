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
                <div class="flex lg:gap-20">
                    {{-- onGoingMatches --}}
                    @foreach ($latestMatch as $match)
                    <div>
                        <div class="text-center mb-8">
                            <span class="text-[#FFFFFF]">Final Score</span>
                        </div>
                        <div class="flex">
                            <div class="flex flex-wrap flex-row">
                                <div class="text-white flex flex-row">
                                    <div class="text-center mr-6">
                                        <div class="h-[50px] xl:h-[78px] mb-4">
                                            <img src="{{asset('/images/countries')}}/{{$match->flag_team1}}" class="h-[50px] md:h-[77px]"/>
                                        </div>
                                        <span class="font-sans text-[16px] font-bold">{{$match->team1}}</span>
                                    </div>
                                    <div class="">
                                        <div class="h-[77px] flex items-center">
                                            <h6 class="text-[40px] md:text-[60px] font-sans leading-[45px]">{{$match->guessing_score_a? $match->guessing_score_a : 0}}</h6>
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
                                            <h6 class="text-[40px] md:text-[60px] font-sans leading-[45px]">{{$match->guessing_score_b ? $match->guessing_score_b : 0}}</h6>
                                        </div>
                                    </div>
                                    <div class="text-center ml-6">
                                        <div class="h-[50px] xl:h-[78px] mb-4">
                                            <img src="{{asset('/images/countries')}}/{{$match->flag_team2}}" class="h-[50px] md:h-[77px]"/>
                                        </div>
                                        <span class="font-sans text-[16px] font-bold">{{$match->team2}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <img src="{{asset("/images/lap2.png")}}" class="w-[1000px] hidden xl:block"/>
            <div class="tebak-quiz hidden xl:flex items-center flex-col mb-20">
                <h2 class="text-black font-head text-[60px] text-center mb-6">IKUT KICKOFF QUIZ UNTUK NAMBAH POIN!</h2>
                @auth
                <div class="qz cursor-pointer bg-black py-1.5 rounded-2xl w-[249px] font-sans text-[14px] text-[#FCEF0A] text-center">Lihat Quiz</div>
                @else
                <a href="{{route('masuk')}}" class="cursor-pointer bg-black py-1.5 rounded-2xl w-[249px] font-sans text-[14px] text-[#FCEF0A] text-center">Lihat Quiz</a>
                @endauth
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

        @if (true)
        {{-- TEBAK SCORE  --}}
        <div class="flex flex-row flex-wrap lg:flex-nowrap gap-2">
            <div class="basis-full lg:basis-1/2 flex flex-wrap bg-[#202124]">
                @auth
                @foreach ($myguess as $key => $match)
                    @if ($key < 8)
                        <div class="basis-full lg:basis-1/2 border-b-[1px] border-r-[1px] border-[#383838] px-4 py-6">
                            @include('web.components.presentational.guessBoxWithLogic',['match'=>$match])
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
                    @if ($key >= 8)
                        <div class="basis-full lg:basis-1/2 border-b-[1px] border-r-[1px] border-[#383838] px-4 py-6">
                            @include('web.components.presentational.guessBoxWithLogic',['match'=>$match])
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
        @else
        {{-- TEBAK BRACKET SCORE  --}}
        <div class="flex flex-row">
            <div class="basis-full flex flex-wrap bg-[#202124] py-4 px-4">
                <div class="w-full">
                    <div class="tournament-headers">
                      <h3 class="font-sans uppercase">Round of 16</h3>
                      <h3 class="font-sans uppercase">Quarter Finals</h3>
                      <h3 class="font-sans uppercase">Semi Finals</h3>
                      <h3 class="font-sans uppercase">Final</h3>
                    </div>

                    <div class="tournament-brackets">
                      <ul class="bracket bracket-1">
                        @auth
                            @foreach ($myguessRound16 as $match)
                                <li class="team-item">
                                    @include('web.components.presentational.guessBoxWithLogic',['match'=>$match])
                                </li>
                            @endforeach
                        @else
                            @for ($i = 0; $i < 8; $i++)
                            <li class="team-item">
                                <span class="block mb-2.5 text-[16px] font-sans text-[#acacac]">Group {{$match->group}} • {{$match->match_time}}</span>
                                <div class="flex flex-wrap">
                                    <ul class="basis-1/2 border-r-[1px] border-[#383838]">
                                        <li class="mb-2 flex items-center">
                                            <p class="text-white font-sans ml-1.5 text-[15px] leading-tight">NA</p>
                                        </li>
                                        <li class="flex items-center">
                                            <p class="text-white font-sans ml-1.5 text-[15px] leading-tight">NA</p>
                                        </li>
                                    </ul>
                                    <div class="basis-1/2 flex items-center justify-center">
                                    </div>
                                </div>
                            </li>
                            @endfor
                        @endauth

                      </ul>
                      <ul class="bracket bracket-2">
                        @auth
                            @foreach ($myguessQuarter as $match)
                                <li class="team-item ">
                                    @include('web.components.presentational.guessBoxWithLogic',['match'=>$match])
                                </li>
                            @endforeach
                        @else
                            @for ($i = 0; $i < 4; $i++)
                            <li class="team-item">
                                <span class="block mb-2.5 text-[16px] font-sans text-[#acacac]">Group {{$match->group}} • {{$match->match_time}}</span>
                                <div class="flex flex-wrap">
                                    <ul class="basis-1/2 border-r-[1px] border-[#383838]">
                                        <li class="mb-2 flex items-center">
                                            <p class="text-white font-sans ml-1.5 text-[15px] leading-tight">NA</p>
                                        </li>
                                        <li class="flex items-center">
                                            <p class="text-white font-sans ml-1.5 text-[15px] leading-tight">NA</p>
                                        </li>
                                    </ul>
                                    <div class="basis-1/2 flex items-center justify-center">
                                    </div>
                                </div>
                            </li>
                            @endfor
                        @endauth
                      </ul>
                      <ul class="bracket bracket-3">
                        @auth
                            @foreach ($myguessSemiFinal as $match)
                                <li class="team-item ">
                                    @include('web.components.presentational.guessBoxWithLogic',['match'=>$match])
                                </li>
                            @endforeach
                        @else
                            @for ($i = 0; $i < 2; $i++)
                            <li class="team-item">
                                <span class="block mb-2.5 text-[16px] font-sans text-[#acacac]">Group {{$match->group}} • {{$match->match_time}}</span>
                                <div class="flex flex-wrap">
                                    <ul class="basis-1/2 border-r-[1px] border-[#383838]">
                                        <li class="mb-2 flex items-center">
                                            <p class="text-white font-sans ml-1.5 text-[15px] leading-tight">NA</p>
                                        </li>
                                        <li class="flex items-center">
                                            <p class="text-white font-sans ml-1.5 text-[15px] leading-tight">NA</p>
                                        </li>
                                    </ul>
                                    <div class="basis-1/2 flex items-center justify-center">
                                    </div>
                                </div>
                            </li>
                            @endfor
                        @endauth
                      </ul>
                      <ul class="bracket bracket-4">
                        @auth
                            @foreach ($myguessFinal as $match)
                            <li class="team-item ">
                                @include('web.components.presentational.guessBoxWithLogic',['match'=>$match])
                            </li>
                            @endforeach
                        @else
                            @for ($i = 0; $i < 1; $i++)
                            <li class="team-item">
                                <span class="block mb-2.5 text-[16px] font-sans text-[#acacac]">Group {{$match->group}} • {{$match->match_time}}</span>
                                <div class="flex flex-wrap">
                                    <ul class="basis-1/2 border-r-[1px] border-[#383838]">
                                        <li class="mb-2 flex items-center">
                                            <p class="text-white font-sans ml-1.5 text-[15px] leading-tight">NA</p>
                                        </li>
                                        <li class="flex items-center">
                                            <p class="text-white font-sans ml-1.5 text-[15px] leading-tight">NA</p>
                                        </li>
                                    </ul>
                                    <div class="basis-1/2 flex items-center justify-center">
                                    </div>
                                </div>
                            </li>
                            @endfor
                        @endauth
                      </ul>
                    </div>
                  </div>
            </div>
        </div>
        @endif
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
                        @auth {{$myranking[0]->rank}} @else 0 @endauth
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
                        @auth {{ Auth::user()->name }} @endauth
                    </li>
                </ul>
                <ul class="flex flex-col justify-center items-center w-[180px]">
                    <li class="text-black text-[36px] leading-[26px] font-sans font-bold">
                        @auth{{$myranking[0]->total_point}}@else 0 @endauth
                    </li>
                    <li class="text-[#A0A0A0] text-[20px] font-sans">Points</li>
                </ul>
            </div>
            <div class="grid grid-cols-4 gap-4 p-8">
                @foreach ($klasemens as $key => $klasemen)
                    <div class="flex items-center">
                        <span class="block font-sans font-bold text-[17px] mr-2 basis-[15%]">{{$key + 1}}</span>
                        <div class="basis-[25%]">
                            <div class="w-[60px] h-[60px] bg-[#D6D6D8] rounded-full flex justify-center items-center mr-4">
                                <?php
                                    $str = $klasemen->name;
                                    $words = explode(' ', $str);
                                    $userInitials = $words[0][0]. $words[1][0]
                                ?>
                            {{$userInitials}}
                            </div>
                        </div>
                        <div class="flex flex-col basis-[55%]">
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

    <div class="overlay hidden fixed top-0 left-0 w-full h-full bg-slate-900 opacity-70 z-40"></div>
    {{-- MODAL TEBAK SKOR --}}
    <div class="modal-form z-50 hidden flex-wrap bg-black w-[400px] md:w-[600px] p-14 fixed top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%]"></div>

    {{-- MODAL QUIZ --}}
    @include('web.components.modal.quiz')

</main>
@endsection