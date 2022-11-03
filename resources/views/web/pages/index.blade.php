@extends('web/components/layout.index')
@section('meta-tag')
<title></title>
<meta name="description" content="meta description">
@endsection
@section('header')
    <header class="relative pt-[85px] sm:pt-[130px] md:pt-0">
        <img src="{{asset('/images/banner.jpg')}}" class="w-full h-full"/>
        @include('web.components.presentational.nav')
    </header>
@endsection
@section('main')
<main>
    <section class="bg-black pt-4 xl:pt-20 pb-8 xl:pb-32 relative px-4 sm:px-8 xl:h-[424px]">
        <div class="relative flex flex-col items-center xl:border-[4px] xl:border-[#383838] w-[90%] m-auto xl:pt-16">
            <div class="text-center xl:absolute bg-black xl:px-20 xl:top-[-40px] xl:h-[40px] xl:left-[50%] xl:translate-x-[-50%]">
                <h3 class="text-[40px] xl:text-[60px] text-white font-head mb-4">Hasil Terakhir</h3>
            </div>
            <div class="flex flex-wrap flex-row justify-center items-center gap-10 mb-4">
                <div class="flex flex-col lg:flex-row lg:gap-20">
                    {{-- Final Match --}}
                    @foreach ($latestMatch as $match)
                    <div class="mb-8">
                        <div class="text-center mb-0 lg:mb-8">
                            <span class="text-[#FFFFFF]">Final Score</span>
                        </div>
                        <div class="flex justify-center">
                            <div class="flex flex-wrap flex-row">
                                <div class="text-white flex flex-row">
                                    <div class="text-center mr-6 flex flex-col items-center w-[60px] md:w-[90px]">
                                        <div class="h-[50px] xl:h-[78px] mb-4">
                                            <img src="{{asset('/images/countries')}}/{{$match->flag_team1}}" class="h-[40px] sm:h-[50px] md:h-[77px]"/>
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
                                    <div class="text-center ml-6 flex flex-col items-center w-[60px] md:w-[90px]">
                                        <div class="h-[50px] xl:h-[78px] mb-4">
                                            <img src="{{asset('/images/countries')}}/{{$match->flag_team2}}" class="h-[40px] sm:h-[50px] md:h-[77px]"/>
                                        </div>
                                        <span class="font-sans text-[13px] lg:text-[16px] font-bold">{{$match->team2}}</span>
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
                    @if(count($checkQuiz) == 0)
                        <div class="qz cursor-pointer bg-black py-4 rounded-3xl w-[249px] font-sans text-[14px] text-[#FCEF0A] text-center z-50">Lihat Quiz</div>
                    @else
                        <div class="qz-disabled cursor-pointer bg-black py-4 rounded-3xl w-[249px] font-sans text-[14px] text-[#FCEF0A] text-center">Lihat Quiz</div>
                    @endif
                @else
                    <a href="{{route('masuk')}}" class="cursor-pointer bg-black py-4 rounded-3xl w-[249px] font-sans text-[14px] text-[#FCEF0A] text-center">Lihat Quiz</a>
                @endauth
            </div>
        </div>
    </section>
    <section class="relative xl:static bg-top bg-cover bg-no-repeat pt-[60px] xl:pt-[25rem] px-8" style="background-image: url(/images/bg-yellow.png)">
        <img src="{{asset("/images/lap2.png")}}" class="block xl:hidden object-contain h-[100px] w-[300px] absolute xl:relative top-[-40px] md:bottom-[-24%] left-[50%] translate-x-[-50%] xl:translate-x-0"/>

        <div class="tebak-quiz flex xl:hidden items-center flex-col mb-20">
            <h2 class="text-black font-head leading-[35px] xl:leading-tight text-[40px] xl:text-[60px] text-center mb-6">IKUT KICKOFF QUIZ UNTUK NAMBAH POIN!</h2>
            <div class="qz bg-black py-1.5 rounded-2xl w-[249px] font-sans text-[14px] text-[#FCEF0A] text-center">Lihat Quiz</div>
        </div>
        <div class="mb-8 mt-12">
            <h2 class="text-black font-head text-[60px] text-center mb-2 uppercase leading-[50px]">Tebak Skor</h2>
            <h5 class="text-black font-head text-[20px] text-center uppercase">PUTARAN KE {{$round[0]->id}}</h5>
        </div>

        @if ($round[0]->id !== 4)
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
                            <span class="block mb-2.5 text-[16px] font-sans text-[#acacac]">Group {{$match->group}} • {{date('M d, H:i', strtotime($match->match_time))}}</span>
                            <div class="flex flex-wrap">
                                <ul class="basis-1/2 border-r-[1px] border-[#383838]">
                                    <li class="mb-2 flex items-center">
                                        <img src="{{asset('/images/countries')}}/{{$match->flag_team1}}" class="h-[30px]"/>
                                        <p class="text-[#989CA5] font-bold font-sans ml-1.5 text-[15px] leading-tight">{{$match->team1}}</p>
                                    </li>
                                    <li class="flex items-center">
                                        <img src="{{asset('/images/countries')}}/{{$match->flag_team2}}" class="h-[30px]"/>
                                        <p class="text-[#989CA5] font-bold font-sans ml-1.5 text-[15px] leading-tight">{{$match->team2}}</p>
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
                        @if ($key >= 8)
                        <div class="basis-full lg:basis-1/2 border-b-[1px] border-r-[1px] border-[#383838] px-4 py-6">
                            <span class="block mb-2.5 text-[16px] font-sans text-[#acacac]">Group {{$match->group}} • {{date('M d, H:i', strtotime($match->match_time))}}</span>
                            <div class="flex flex-wrap">
                                <ul class="basis-1/2 border-r-[1px] border-[#383838]">
                                    <li class="mb-2 flex items-center">
                                        <img src="{{asset('/images/countries')}}/{{$match->flag_team1}}" class="h-[30px]"/>
                                        <p class="text-[#989CA5] font-bold font-sans ml-1.5 text-[15px] leading-tight">{{$match->team1}}</p>
                                    </li>
                                    <li class="flex items-center">
                                        <img src="{{asset('/images/countries')}}/{{$match->flag_team2}}" class="h-[30px]"/>
                                        <p class="text-[#989CA5] font-bold font-sans ml-1.5 text-[15px] leading-tight">{{$match->team2}}</p>
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
        <div class="overflow-auto ">
            <div class="flex flex-row w-[1200px] lg:w-full ">
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
                                @foreach($match_round_16 as $match)
                                <li class="team-item">
                                    <span class="block mb-2.5 text-[16px] font-sans text-[#acacac]">{{$match->round}} • {{date('M d, H:i', strtotime($match->match_time))}}</span>
                                    <div class="flex flex-wrap">
                                        <ul class="basis-1/2 border-r-[1px] border-[#383838]">
                                            <li class="mb-2 flex items-center">
                                                @if($match->team1 == 'NA')
                                                <div class="rounded-full w-[30px] h-[30px] bg-[#989CA5]"></div>
                                                @else
                                                <img src="{{asset('/images/countries')}}/{{$match->flag_team1}}" class="h-[30px]"/>
                                                @endif
                                                <p class="text-[#989CA5] font-bold font-sans ml-1.5 text-[15px] leading-tight">{{$match->team1}}</p>
                                            </li>
                                            <li class="flex items-center">
                                                @if($match->team2 == 'NA')
                                                <div class="rounded-full w-[30px] h-[30px] bg-[#989CA5]"></div>
                                                @else
                                                <img src="{{asset('/images/countries')}}/{{$match->flag_team2}}" class="h-[30px]"/>
                                                @endif
                                                <p class="text-[#989CA5] font-bold font-sans ml-1.5 text-[15px] leading-tight">{{$match->team2}}</p>
                                            </li>
                                        </ul>
                                        @if ($match->team1 !== 'NA')
                                        <div class="basis-1/2 flex items-center justify-center">
                                            <a href="{{route('masuk')}}" class="bg-[#FF0000] text-white text-[12px] rounded-2xl py-1 px-2 w-[100px] text-center cursor-pointer">Tebak Skor</a>
                                        </div>
                                        @endif
                                    </div>
                                </li>
                                @endforeach
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
                                @foreach($match_quarter as $match)
                                <li class="team-item">
                                    <span class="block mb-2.5 text-[16px] font-sans text-[#acacac]">{{$match->round}} • {{date('M d, H:i', strtotime($match->match_time))}}</span>
                                    <div class="flex flex-wrap">
                                        <ul class="basis-1/2 border-r-[1px] border-[#383838]">
                                            <li class="mb-2 flex items-center">
                                                @if($match->team1 == 'NA')
                                                <div class="rounded-full w-[30px] h-[30px] bg-[#989CA5]"></div>
                                                @else
                                                <img src="{{asset('/images/countries')}}/{{$match->flag_team1}}" class="h-[30px]"/>
                                                @endif
                                                <p class="text-[#989CA5] font-bold font-sans ml-1.5 text-[15px] leading-tight">{{$match->team1}}</p>
                                            </li>
                                            <li class="flex items-center">
                                                @if($match->team2 == 'NA')
                                                <div class="rounded-full w-[30px] h-[30px] bg-[#989CA5]"></div>
                                                @else
                                                <img src="{{asset('/images/countries')}}/{{$match->flag_team2}}" class="h-[30px]"/>
                                                @endif
                                                <p class="text-[#989CA5] font-bold font-sans ml-1.5 text-[15px] leading-tight">{{$match->team2}}</p>
                                            </li>
                                        </ul>
                                        @if ($match->team1 !== 'NA')
                                        <div class="basis-1/2 flex items-center justify-center">
                                            <a href="{{route('masuk')}}" class="bg-[#FF0000] text-white text-[12px] rounded-2xl py-1 px-2 w-[100px] text-center cursor-pointer">Tebak Skor</a>
                                        </div>
                                        @endif
                                    </div>
                                </li>
                                @endforeach
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
                                @foreach($match_semi_finals as $match)
                                <li class="team-item">
                                    <span class="block mb-2.5 text-[16px] font-sans text-[#acacac]">{{$match->round}} • {{date('M d, H:i', strtotime($match->match_time))}}</span>
                                    <div class="flex flex-wrap">
                                        <ul class="basis-1/2 border-r-[1px] border-[#383838]">
                                            <li class="mb-2 flex items-center">
                                                @if($match->team1 == 'NA')
                                                <div class="rounded-full w-[30px] h-[30px] bg-[#989CA5]"></div>
                                                @else
                                                <img src="{{asset('/images/countries')}}/{{$match->flag_team1}}" class="h-[30px]"/>
                                                @endif
                                                <p class="text-[#989CA5] font-bold font-sans ml-1.5 text-[15px] leading-tight">{{$match->team1}}</p>
                                            </li>
                                            <li class="flex items-center">
                                                @if($match->team2 == 'NA')
                                                <div class="rounded-full w-[30px] h-[30px] bg-[#989CA5]"></div>
                                                @else
                                                <img src="{{asset('/images/countries')}}/{{$match->flag_team2}}" class="h-[30px]"/>
                                                @endif
                                                <p class="text-[#989CA5] font-bold font-sans ml-1.5 text-[15px] leading-tight">{{$match->team2}}</p>
                                            </li>
                                        </ul>
                                        @if ($match->team1 !== 'NA')
                                        <div class="basis-1/2 flex items-center justify-center">
                                            <a href="{{route('masuk')}}" class="bg-[#FF0000] text-white text-[12px] rounded-2xl py-1 px-2 w-[100px] text-center cursor-pointer">Tebak Skor</a>
                                        </div>
                                        @endif
                                    </div>
                                </li>
                                @endforeach
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
                                @foreach($match_final as $match)
                                <li class="team-item">
                                    <span class="block mb-2.5 text-[16px] font-sans text-[#acacac]">{{$match->round}} • {{date('M d, H:i', strtotime($match->match_time))}}</span>
                                    <div class="flex flex-wrap">
                                        <ul class="basis-1/2 border-r-[1px] border-[#383838]">
                                            <li class="mb-2 flex items-center">
                                                @if($match->team1 == 'NA')
                                                <div class="rounded-full w-[30px] h-[30px] bg-[#989CA5]"></div>
                                                @else
                                                <img src="{{asset('/images/countries')}}/{{$match->flag_team1}}" class="h-[30px]"/>
                                                @endif
                                                <p class="text-[#989CA5] font-bold font-sans ml-1.5 text-[15px] leading-tight">{{$match->team1}}</p>
                                            </li>
                                            <li class="flex items-center">
                                                @if($match->team2 == 'NA')
                                                <div class="rounded-full w-[30px] h-[30px] bg-[#989CA5]"></div>
                                                @else
                                                <img src="{{asset('/images/countries')}}/{{$match->flag_team2}}" class="h-[30px]"/>
                                                @endif
                                                <p class="text-[#989CA5] font-bold font-sans ml-1.5 text-[15px] leading-tight">{{$match->team2}}</p>
                                            </li>
                                        </ul>
                                        @if ($match->team1 !== 'NA')
                                        <div class="basis-1/2 flex items-center justify-center">
                                            <a href="{{route('masuk')}}" class="bg-[#FF0000] text-white text-[12px] rounded-2xl py-1 px-2 w-[100px] text-center cursor-pointer">Tebak Skor</a>
                                        </div>
                                        @endif
                                    </div>
                                </li>
                                @endforeach
                            @endauth
                        </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </section>
    <section class="relative bg-[#FFEC00] px-8 pt-6">
        <div class="bg-[#F8F8F8] px-3 py-8 lg:p-10">
            <div class="flex flex-col">
                <h2 class="text-black font-head text-[50px] lg:text-[60px] leading-[50px] mb-4 m-auto inline-block">LEADERBOARD</h2>
                <h5 class="text-black font-head text-[20px] m-auto inline-block">STATISTIK ANDA<h5>
            </div>
            <div class="flex flex-col lg:flex-row justify-center pt-4 pb-8 gap-12 items-center">
                <ul class="flex order-2 lg:order-1 flex-col justify-center items-center w-[180px]">
                    <li class="text-black text-[36px] leading-[26px] font-sans font-bold">
                        @auth 
                        <?php 
                        if (count($myranking)>0) {
                            echo $myranking[0]->rank;
                        }
                        ?>
                        @else 0 @endauth
                    </li>
                    <li class="text-[#A0A0A0] text-[20px] font-sans">Ranking</li>
                </ul>
                <ul class="flex order-1 lg:order-2 flex-col justify-center items-center">
                    <li class="uppercase text-black text-[16px] bg-[#FFEC00] p-2 leading-[26px] font-sans font-bold w-[63px] h-[63px] rounded-full flex justify-center items-center mb-2">
                        @auth
                        <?php
                            $str = Auth::user()->name;
                            $words = explode(' ', $str);
                            $si = count($words) > 1 ? $words[1][0] : '';
                            $userInitials = $words[0][0]. $si;
                        ?>
                        {{$userInitials}}
                        @endauth
                    </li>
                    <li class="text-black text-[16px] font-sans font-bold">
                        @auth {{ Auth::user()->name }} @endauth
                    </li>
                </ul>
                <ul class="flex order-3 lg:order-3 flex-col justify-center items-center w-[180px]">
                    <li class="text-black text-[36px] leading-[26px] font-sans font-bold">
                        @auth
                        @if (count($myranking)>0)
                        {{$myranking[0]->total_point}}
                        @endif
                        @else 0 @endauth
                    </li>
                    <li class="text-[#A0A0A0] text-[20px] font-sans">Points</li>
                </ul>
            </div>
            <div class="lg:p-8 pb-8">
                <div class="md:text-start text-center">
                    <label class="text-black font-sans text-[14px] font-semibold">Urutan Leaderboard</label>
                    <select class="bg-transparent rounded-2xl lg:ml-5 w-full md:w-[200px] select-putaran">
                        <option value="5" selected>Semua putaran</option>
                        <option value="1">Putaran 1</option>
                        <option value="2">Putaran 2</option>
                        <option value="3">Putaran 3</option>
                        <option value="4">Putaran 4</option>
                    </select>
                </div>
            </div>
            {{-- grid-flow-col --}}
            <div class="klasemen grid grid-cols-1 lg:grid-rows-4 lg:grid-flow-col  gap-4 lg:p-8"></div>
            <div class="flex mt-5">
                <nav class="m-auto" aria-label="Page navigation example">
                    <ul class="inline-flex items-center -space-x-px">
                        {{-- <li>
                            <p class="prevPage cursor-pointer block py-2 px-3 ml-0 leading-tight text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <span class="sr-only">Previous</span>
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                            </p>
                        </li> --}}
                        @for ($i = 0; $i < $totalPage; $i++)
                            <li>
                                <p page="{{$i}}" class="selectPage cursor-pointer py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{{$i+1}}</p>
                            </li>
                        @endfor
                        {{-- <li>
                            <p class="nextPage cursor-pointer block py-2 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <span class="sr-only">Next</span>
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            </p>
                        </li> --}}
                    </ul>
                </nav>
                {{-- <div class="m-auto loadMore cursor-pointer bg-black py-4 rounded-3xl w-[249px] font-sans text-[14px] text-[#FCEF0A] text-center">Lihat Semua Leaderboard</div> --}}
            </div>
        </div>
    </section>
    <div class="pb-14 pt-10 bg-[#FFEC00]">
        <img alt="logo extra joss" class="m-auto mb-2" src="{{asset('/images/logo.png')}}"/>
        <p class="font-sans text-center text-[10px]">Copyright © 2022 ExtraJoss</p>
    </div>

    <div class="overlay hidden fixed top-0 left-0 w-full h-full bg-slate-900 opacity-70 z-40"></div>
    {{-- MODAL TEBAK SKOR --}}
    <div class="modal-form z-50 hidden flex-wrap bg-[#FCEF0A] w-[400px] md:w-[600px] p-14 fixed top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%]"></div>

    {{-- MODAL QUIZ --}}
    @include('web.components.modal.quiz')
    <div class="modal-quizDis z-50 hidden flex-wrap bg-black w-[400px] md:w-[600px] p-4 lg:p-14 fixed top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%]">
        <div class="close">
            <div class="">
                <img src="{{asset('/images/close.png')}}" />
            </div>
        </div>
        <h3 class="text-[#FCEF0A] font-head text-[35px] leading-[25px]">Anda Sudah Mengikuti Quiz</h3>
    </div>
</main>
@endsection