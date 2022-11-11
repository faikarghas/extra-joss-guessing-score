@extends('web/components/layout.index')
@section('meta-tag')
<title></title>
<meta name="description" content="meta description">
@endsection
@section('header')
    <div class="relative h-full">
    <header class="relative info bg-no-repeat bg-cover bg-[#FFEC00]" >
        @include('web.components.presentational.nav')
        <section class="relative z-20 m-auto lg:w-[95%] pt-[124px] md:pt-[85px] sm:pt-[130px] lg:pt-[160px] px-8">
            <div class="bg-[#202124]  pt-12 flex flex-col">
                <h1 class="text-white text-[60px] font-head mb-8 lg:pl-12 leading-[50px] px-4">HASIL PERTANDINGAN</h1>

                <div class="flex flex-col mb-12">
                    <div class="basis-full"><h3 class="font-sans text-white font-bold text-[20px] lg:pl-12 px-4">Putaran 1</h3></div>
                    <div class="flex flex-row flex-wrap lg:flex-nowrap gap-2">
                        <div class="basis-full flex flex-wrap bg-[#202124]">
                            @auth
                                @foreach ($myguess1 as $key => $match)
                                <div class="basis-full lg:basis-1/4 border-b-[1px] border-r-[1px] border-[#383838] px-4 py-6">
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
                                            <ul class="score">
                                                <li class="flex items-center justify-center">
                                                    <p class="text-[#6D6D6D] font-sans text-[22px] font-bold leading-tight">{{$match->score_a}}</p>
                                                </li>
                                                <li class="flex items-center justify-center">
                                                    <p class="text-[#6D6D6D] font-sans text-[22px] font-bold leading-tight">{{$match->score_b}}</p>
                                                </li>
                                            </ul>
                                            <?php
                                                $datetime = date($match->match_time);
                                                $timestamp = strtotime($datetime);
                                                $time = $timestamp - (1 * 60 * 60);
                                                $datetime = date("Y-m-d H:i:s", $time);

                                                $d1 = new DateTime($currentTime);
                                                $d2 = new DateTime($datetime);
                                            ?>
                                            @if ($d1 < $d2)
                                                @if ($match->is_guess == 1)
                                                    @if($match->guessing_result == 1)
                                                    <div class="flex items-center ml-2">
                                                        <img src="{{asset('images/acvcolor.png')}}" class="h-[35px]"/>
                                                        <div>
                                                            <span class="block font-sans text-[10px] text-[#FFA800]">Anda dapat</span>
                                                            <span class="block font-sans text-[12px] font-bold text-[#FFA800]">1000 Poin</span>
                                                        </div>
                                                    </div>
                                                    @elseif($match->guessing_result == 0)
                                                    <div class="flex items-center ml-2">
                                                        <img src="{{asset('images/acvgrey.png')}}" class="h-[35px]"/>
                                                        <div>
                                                            <span class="block font-sans text-[10px] text-[#6D6D6D]">Anda dapat</span>
                                                            <span class="block font-sans text-[12px] font-bold text-[#6D6D6D]">0 Poin</span>
                                                        </div>
                                                    </div>
                                                    @endif
                                                @endif
                                            @else
                                                @if ($match->is_guess == 1)
                                                    @if($match->guessing_result == 1)
                                                    <div class="flex items-center ml-2">
                                                        <img src="{{asset('images/acvcolor.png')}}" class="h-[35px]"/>
                                                        <div>
                                                            <span class="block font-sans text-[10px] text-[#FFA800]">Anda dapat</span>
                                                            <span class="block font-sans text-[12px] font-bold text-[#FFA800]">1000 Poin</span>
                                                        </div>
                                                    </div>
                                                    @else
                                                    <div class="flex items-center ml-2">
                                                        <img src="{{asset('images/acvgrey.png')}}" class="h-[35px]"/>
                                                        <div>
                                                            <span class="block font-sans text-[10px] text-[#6D6D6D]">Anda dapat</span>
                                                            <span class="block font-sans text-[12px] font-bold text-[#6D6D6D]">0 Poin</span>
                                                        </div>
                                                    </div>
                                                    @endif
                                                @else
                                                    <div class="flex items-center ml-2">
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
                                @endforeach
                            @else
                                @foreach ($matches1 as $key => $match)
                                    <div class="basis-full lg:basis-1/4 border-b-[1px] border-r-[1px] border-[#383838] px-4 py-6">
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
                                                <ul class="score">
                                                    <li class="flex items-center justify-center">
                                                        <p class="text-[#6D6D6D] font-sans text-[22px] font-bold leading-tight">{{$match->score_a}}</p>
                                                    </li>
                                                    <li class="flex items-center justify-center">
                                                        <p class="text-[#6D6D6D] font-sans text-[22px] font-bold leading-tight">{{$match->score_b}}</p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endauth
                        </div>
                    </div>
                </div>

                <div class="flex flex-col mb-12">
                    <div class="basis-full"><h3 class="font-sans text-white font-bold text-[20px] lg:pl-12 px-4">Putaran 2</h3></div>
                    <div class="flex flex-row flex-wrap lg:flex-nowrap gap-2">
                        <div class="basis-full flex flex-wrap bg-[#202124]">
                            @auth
                                @foreach ($myguess2 as $key => $match)
                                <div class="basis-full lg:basis-1/4 border-b-[1px] border-r-[1px] border-[#383838] px-4 py-6">
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
                                            <ul class="score">
                                                <li class="flex items-center justify-center">
                                                    <p class="text-[#6D6D6D] font-sans text-[22px] font-bold leading-tight">{{$match->score_a}}</p>
                                                </li>
                                                <li class="flex items-center justify-center">
                                                    <p class="text-[#6D6D6D] font-sans text-[22px] font-bold leading-tight">{{$match->score_b}}</p>
                                                </li>
                                            </ul>
                                            <?php
                                                $datetime = date($match->match_time);
                                                $timestamp = strtotime($datetime);
                                                $time = $timestamp - (1 * 60 * 60);
                                                $datetime = date("Y-m-d H:i:s", $time);

                                                $d1 = new DateTime($currentTime);
                                                $d2 = new DateTime($datetime);
                                            ?>
                                            @if ($d1 < $d2)
                                                @if ($match->is_guess == 1)
                                                    @if($match->guessing_result == 1)
                                                    <div class="flex items-center ml-2">
                                                        <img src="{{asset('images/acvcolor.png')}}" class="h-[35px]"/>
                                                        <div>
                                                            <span class="block font-sans text-[10px] text-[#FFA800]">Anda dapat</span>
                                                            <span class="block font-sans text-[12px] font-bold text-[#FFA800]">1000 Poin</span>
                                                        </div>
                                                    </div>
                                                    @elseif($match->guessing_result == 0)
                                                    <div class="flex items-center ml-2">
                                                        <img src="{{asset('images/acvgrey.png')}}" class="h-[35px]"/>
                                                        <div>
                                                            <span class="block font-sans text-[10px] text-[#6D6D6D]">Anda dapat</span>
                                                            <span class="block font-sans text-[12px] font-bold text-[#6D6D6D]">0 Poin</span>
                                                        </div>
                                                    </div>
                                                    @endif
                                                @endif
                                            @else
                                                @if ($match->is_guess == 1)
                                                    @if($match->guessing_result == 1)
                                                    <div class="flex items-center ml-2">
                                                        <img src="{{asset('images/acvcolor.png')}}" class="h-[35px]"/>
                                                        <div>
                                                            <span class="block font-sans text-[10px] text-[#FFA800]">Anda dapat</span>
                                                            <span class="block font-sans text-[12px] font-bold text-[#FFA800]">1000 Poin</span>
                                                        </div>
                                                    </div>
                                                    @else
                                                    <div class="flex items-center ml-2">
                                                        <img src="{{asset('images/acvgrey.png')}}" class="h-[35px]"/>
                                                        <div>
                                                            <span class="block font-sans text-[10px] text-[#6D6D6D]">Anda dapat</span>
                                                            <span class="block font-sans text-[12px] font-bold text-[#6D6D6D]">0 Poin</span>
                                                        </div>
                                                    </div>
                                                    @endif
                                                @else
                                                    <div class="flex items-center ml-2">
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
                                @endforeach
                            @else
                                @foreach ($matches2 as $key => $match)
                                    <div class="basis-full lg:basis-1/4 border-b-[1px] border-r-[1px] border-[#383838] px-4 py-6">
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
                                                <ul class="score">
                                                    <li class="flex items-center justify-center">
                                                        <p class="text-[#6D6D6D] font-sans text-[22px] font-bold leading-tight">{{$match->score_a}}</p>
                                                    </li>
                                                    <li class="flex items-center justify-center">
                                                        <p class="text-[#6D6D6D] font-sans text-[22px] font-bold leading-tight">{{$match->score_b}}</p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endauth
                        </div>
                    </div>
                </div>

                <div class="flex flex-col mb-12">
                    <div class="basis-full"><h3 class="font-sans text-white font-bold text-[20px] lg:pl-12 px-4">Putaran 3</h3></div>
                    <div class="flex flex-row flex-wrap lg:flex-nowrap gap-2">
                        <div class="basis-full flex flex-wrap bg-[#202124]">
                            @auth
                                @foreach ($myguess3 as $key => $match)
                                <div class="basis-full lg:basis-1/4 border-b-[1px] border-r-[1px] border-[#383838] px-4 py-6">
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
                                            <ul class="score">
                                                <li class="flex items-center justify-center">
                                                    <p class="text-[#6D6D6D] font-sans text-[22px] font-bold leading-tight">{{$match->score_a}}</p>
                                                </li>
                                                <li class="flex items-center justify-center">
                                                    <p class="text-[#6D6D6D] font-sans text-[22px] font-bold leading-tight">{{$match->score_b}}</p>
                                                </li>
                                            </ul>
                                            <?php
                                                $datetime = date($match->match_time);
                                                $timestamp = strtotime($datetime);
                                                $time = $timestamp - (1 * 60 * 60);
                                                $datetime = date("Y-m-d H:i:s", $time);

                                                $d1 = new DateTime($currentTime);
                                                $d2 = new DateTime($datetime);
                                            ?>
                                            @if ($d1 < $d2)
                                                @if ($match->is_guess == 1)
                                                    @if($match->guessing_result == 1)
                                                    <div class="flex items-center ml-2">
                                                        <img src="{{asset('images/acvcolor.png')}}" class="h-[35px]"/>
                                                        <div>
                                                            <span class="block font-sans text-[10px] text-[#FFA800]">Anda dapat</span>
                                                            <span class="block font-sans text-[12px] font-bold text-[#FFA800]">1000 Poin</span>
                                                        </div>
                                                    </div>
                                                    @elseif($match->guessing_result == 0)
                                                    <div class="flex items-center ml-2">
                                                        <img src="{{asset('images/acvgrey.png')}}" class="h-[35px]"/>
                                                        <div>
                                                            <span class="block font-sans text-[10px] text-[#6D6D6D]">Anda dapat</span>
                                                            <span class="block font-sans text-[12px] font-bold text-[#6D6D6D]">0 Poin</span>
                                                        </div>
                                                    </div>
                                                    @endif
                                                @endif
                                            @else
                                                @if ($match->is_guess == 1)
                                                    @if($match->guessing_result == 1)
                                                    <div class="flex items-center ml-2">
                                                        <img src="{{asset('images/acvcolor.png')}}" class="h-[35px]"/>
                                                        <div>
                                                            <span class="block font-sans text-[10px] text-[#FFA800]">Anda dapat</span>
                                                            <span class="block font-sans text-[12px] font-bold text-[#FFA800]">1000 Poin</span>
                                                        </div>
                                                    </div>
                                                    @else
                                                    <div class="flex items-center ml-2">
                                                        <img src="{{asset('images/acvgrey.png')}}" class="h-[35px]"/>
                                                        <div>
                                                            <span class="block font-sans text-[10px] text-[#6D6D6D]">Anda dapat</span>
                                                            <span class="block font-sans text-[12px] font-bold text-[#6D6D6D]">0 Poin</span>
                                                        </div>
                                                    </div>
                                                    @endif
                                                @else
                                                    <div class="flex items-center ml-2">
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
                                @endforeach
                            @else
                                @foreach ($matches3 as $key => $match)
                                    <div class="basis-full lg:basis-1/4 border-b-[1px] border-r-[1px] border-[#383838] px-4 py-6">
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
                                                <ul class="score">
                                                    <li class="flex items-center justify-center">
                                                        <p class="text-[#6D6D6D] font-sans text-[22px] font-bold leading-tight">{{$match->score_a}}</p>
                                                    </li>
                                                    <li class="flex items-center justify-center">
                                                        <p class="text-[#6D6D6D] font-sans text-[22px] font-bold leading-tight">{{$match->score_b}}</p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endauth
                        </div>
                    </div>
                </div>

                <div class="overflow-auto ">
                    <div class="flex flex-row w-[1200px] lg:w-full ">
                        <div class="basis-full flex flex-wrap bg-[#202124] py-4 px-4 relative">
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
                                                        <ul class="score">
                                                            <li class="flex items-center justify-center">
                                                                <p class="text-[#6D6D6D] font-sans text-[22px] font-bold leading-tight">{{$match->score_a}}</p>
                                                            </li>
                                                            <li class="flex items-center justify-center">
                                                                <p class="text-[#6D6D6D] font-sans text-[22px] font-bold leading-tight">{{$match->score_b}}</p>
                                                            </li>
                                                        </ul>
                                                        <?php
                                                            $datetime = date($match->match_time);
                                                            $timestamp = strtotime($datetime);
                                                            $time = $timestamp - (1 * 60 * 60);
                                                            $datetime = date("Y-m-d H:i:s", $time);

                                                            $d1 = new DateTime($currentTime);
                                                            $d2 = new DateTime($datetime);
                                                        ?>
                                                        @if ($d1 < $d2)
                                                            @if ($match->is_guess == 1)
                                                                @if($match->guessing_result == 1)
                                                                <div class="flex items-center ml-2">
                                                                    <img src="{{asset('images/acvcolor.png')}}" class="h-[35px]"/>
                                                                    <div>
                                                                        <span class="block font-sans text-[10px] text-[#FFA800]">Anda dapat</span>
                                                                        <span class="block font-sans text-[12px] font-bold text-[#FFA800]">1000 Poin</span>
                                                                    </div>
                                                                </div>
                                                                @elseif($match->guessing_result == 0)
                                                                <div class="flex items-center ml-2">
                                                                    <img src="{{asset('images/acvgrey.png')}}" class="h-[35px]"/>
                                                                    <div>
                                                                        <span class="block font-sans text-[10px] text-[#6D6D6D]">Anda dapat</span>
                                                                        <span class="block font-sans text-[12px] font-bold text-[#6D6D6D]">0 Poin</span>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            @endif
                                                        @else
                                                            @if ($match->is_guess == 1)
                                                                @if($match->guessing_result == 1)
                                                                <div class="flex items-center ml-2">
                                                                    <img src="{{asset('images/acvcolor.png')}}" class="h-[35px]"/>
                                                                    <div>
                                                                        <span class="block font-sans text-[10px] text-[#FFA800]">Anda dapat</span>
                                                                        <span class="block font-sans text-[12px] font-bold text-[#FFA800]">1000 Poin</span>
                                                                    </div>
                                                                </div>
                                                                @else
                                                                <div class="flex items-center ml-2">
                                                                    <img src="{{asset('images/acvgrey.png')}}" class="h-[35px]"/>
                                                                    <div>
                                                                        <span class="block font-sans text-[10px] text-[#6D6D6D]">Anda dapat</span>
                                                                        <span class="block font-sans text-[12px] font-bold text-[#6D6D6D]">0 Poin</span>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            @else
                                                                <div class="flex items-center ml-2">
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
                                                        <ul class="score">
                                                            <li class="flex items-center justify-center">
                                                                <p class="text-[#6D6D6D] font-sans text-[22px] font-bold leading-tight">{{$match->score_a}}</p>
                                                            </li>
                                                            <li class="flex items-center justify-center">
                                                                <p class="text-[#6D6D6D] font-sans text-[22px] font-bold leading-tight">{{$match->score_b}}</p>
                                                            </li>
                                                        </ul>
                                                        <?php
                                                            $datetime = date($match->match_time);
                                                            $timestamp = strtotime($datetime);
                                                            $time = $timestamp - (1 * 60 * 60);
                                                            $datetime = date("Y-m-d H:i:s", $time);

                                                            $d1 = new DateTime($currentTime);
                                                            $d2 = new DateTime($datetime);
                                                        ?>
                                                        @if ($d1 < $d2)
                                                            @if ($match->is_guess == 1)
                                                                @if($match->guessing_result == 1)
                                                                <div class="flex items-center ml-2">
                                                                    <img src="{{asset('images/acvcolor.png')}}" class="h-[35px]"/>
                                                                    <div>
                                                                        <span class="block font-sans text-[10px] text-[#FFA800]">Anda dapat</span>
                                                                        <span class="block font-sans text-[12px] font-bold text-[#FFA800]">1000 Poin</span>
                                                                    </div>
                                                                </div>
                                                                @elseif($match->guessing_result == 0)
                                                                <div class="flex items-center ml-2">
                                                                    <img src="{{asset('images/acvgrey.png')}}" class="h-[35px]"/>
                                                                    <div>
                                                                        <span class="block font-sans text-[10px] text-[#6D6D6D]">Anda dapat</span>
                                                                        <span class="block font-sans text-[12px] font-bold text-[#6D6D6D]">0 Poin</span>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            @endif
                                                        @else
                                                            <div class="flex items-center ml-2">
                                                                <img src="{{asset('images/acvgrey.png')}}" class="h-[35px]"/>
                                                                <div>
                                                                    <span class="block font-sans text-[10px] text-[#6D6D6D]">Anda dapat</span>
                                                                    <span class="block font-sans text-[12px] font-bold text-[#6D6D6D]">0 Poin</span>
                                                                </div>
                                                            </div>
                                                        @endif
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
                                            <li class="team-item">
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
                                                        <ul class="score">
                                                            <li class="flex items-center justify-center">
                                                                <p class="text-[#6D6D6D] font-sans text-[22px] font-bold leading-tight">{{$match->score_a}}</p>
                                                            </li>
                                                            <li class="flex items-center justify-center">
                                                                <p class="text-[#6D6D6D] font-sans text-[22px] font-bold leading-tight">{{$match->score_b}}</p>
                                                            </li>
                                                        </ul>
                                                        <?php
                                                            $datetime = date($match->match_time);
                                                            $timestamp = strtotime($datetime);
                                                            $time = $timestamp - (1 * 60 * 60);
                                                            $datetime = date("Y-m-d H:i:s", $time);

                                                            $d1 = new DateTime($currentTime);
                                                            $d2 = new DateTime($datetime);
                                                        ?>
                                                        @if ($d1 < $d2)
                                                            @if ($match->is_guess == 1)
                                                                @if($match->guessing_result == 1)
                                                                <div class="flex items-center ml-2">
                                                                    <img src="{{asset('images/acvcolor.png')}}" class="h-[35px]"/>
                                                                    <div>
                                                                        <span class="block font-sans text-[10px] text-[#FFA800]">Anda dapat</span>
                                                                        <span class="block font-sans text-[12px] font-bold text-[#FFA800]">1000 Poin</span>
                                                                    </div>
                                                                </div>
                                                                @elseif($match->guessing_result == 0)
                                                                <div class="flex items-center ml-2">
                                                                    <img src="{{asset('images/acvgrey.png')}}" class="h-[35px]"/>
                                                                    <div>
                                                                        <span class="block font-sans text-[10px] text-[#6D6D6D]">Anda dapat</span>
                                                                        <span class="block font-sans text-[12px] font-bold text-[#6D6D6D]">0 Poin</span>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            @endif
                                                        @else
                                                            @if ($match->is_guess == 1)
                                                                @if($match->guessing_result == 1)
                                                                <div class="flex items-center ml-2">
                                                                    <img src="{{asset('images/acvcolor.png')}}" class="h-[35px]"/>
                                                                    <div>
                                                                        <span class="block font-sans text-[10px] text-[#FFA800]">Anda dapat</span>
                                                                        <span class="block font-sans text-[12px] font-bold text-[#FFA800]">1000 Poin</span>
                                                                    </div>
                                                                </div>
                                                                @else
                                                                <div class="flex items-center ml-2">
                                                                    <img src="{{asset('images/acvgrey.png')}}" class="h-[35px]"/>
                                                                    <div>
                                                                        <span class="block font-sans text-[10px] text-[#6D6D6D]">Anda dapat</span>
                                                                        <span class="block font-sans text-[12px] font-bold text-[#6D6D6D]">0 Poin</span>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            @else
                                                                <div class="flex items-center ml-2">
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
                                                    <ul class="score">
                                                        <li class="flex items-center justify-center">
                                                            <p class="text-[#6D6D6D] font-sans text-[22px] font-bold leading-tight">{{$match->score_a}}</p>
                                                        </li>
                                                        <li class="flex items-center justify-center">
                                                            <p class="text-[#6D6D6D] font-sans text-[22px] font-bold leading-tight">{{$match->score_b}}</p>
                                                        </li>
                                                    </ul>
                                                    <?php
                                                        $datetime = date($match->match_time);
                                                        $timestamp = strtotime($datetime);
                                                        $time = $timestamp - (1 * 60 * 60);
                                                        $datetime = date("Y-m-d H:i:s", $time);

                                                        $d1 = new DateTime($currentTime);
                                                        $d2 = new DateTime($datetime);
                                                    ?>
                                                    @if ($d1 < $d2)
                                                        @if ($match->is_guess == 1)
                                                            @if($match->guessing_result == 1)
                                                            <div class="flex items-center ml-2">
                                                                <img src="{{asset('images/acvcolor.png')}}" class="h-[35px]"/>
                                                                <div>
                                                                    <span class="block font-sans text-[10px] text-[#FFA800]">Anda dapat</span>
                                                                    <span class="block font-sans text-[12px] font-bold text-[#FFA800]">1000 Poin</span>
                                                                </div>
                                                            </div>
                                                            @elseif($match->guessing_result == 0)
                                                            <div class="flex items-center ml-2">
                                                                <img src="{{asset('images/acvgrey.png')}}" class="h-[35px]"/>
                                                                <div>
                                                                    <span class="block font-sans text-[10px] text-[#6D6D6D]">Anda dapat</span>
                                                                    <span class="block font-sans text-[12px] font-bold text-[#6D6D6D]">0 Poin</span>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        @endif
                                                    @else
                                                        <div class="flex items-center ml-2">
                                                            <img src="{{asset('images/acvgrey.png')}}" class="h-[35px]"/>
                                                            <div>
                                                                <span class="block font-sans text-[10px] text-[#6D6D6D]">Anda dapat</span>
                                                                <span class="block font-sans text-[12px] font-bold text-[#6D6D6D]">0 Poin</span>
                                                            </div>
                                                        </div>
                                                    @endif
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
                                            <li class="team-item">
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
                                                        <ul class="score">
                                                            <li class="flex items-center justify-center">
                                                                <p class="text-[#6D6D6D] font-sans text-[22px] font-bold leading-tight">{{$match->score_a}}</p>
                                                            </li>
                                                            <li class="flex items-center justify-center">
                                                                <p class="text-[#6D6D6D] font-sans text-[22px] font-bold leading-tight">{{$match->score_b}}</p>
                                                            </li>
                                                        </ul>
                                                        <?php
                                                            $datetime = date($match->match_time);
                                                            $timestamp = strtotime($datetime);
                                                            $time = $timestamp - (1 * 60 * 60);
                                                            $datetime = date("Y-m-d H:i:s", $time);

                                                            $d1 = new DateTime($currentTime);
                                                            $d2 = new DateTime($datetime);
                                                        ?>
                                                        @if ($d1 < $d2)
                                                            @if ($match->is_guess == 1)
                                                                @if($match->guessing_result == 1)
                                                                <div class="flex items-center ml-2">
                                                                    <img src="{{asset('images/acvcolor.png')}}" class="h-[35px]"/>
                                                                    <div>
                                                                        <span class="block font-sans text-[10px] text-[#FFA800]">Anda dapat</span>
                                                                        <span class="block font-sans text-[12px] font-bold text-[#FFA800]">1000 Poin</span>
                                                                    </div>
                                                                </div>
                                                                @elseif($match->guessing_result == 0)
                                                                <div class="flex items-center ml-2">
                                                                    <img src="{{asset('images/acvgrey.png')}}" class="h-[35px]"/>
                                                                    <div>
                                                                        <span class="block font-sans text-[10px] text-[#6D6D6D]">Anda dapat</span>
                                                                        <span class="block font-sans text-[12px] font-bold text-[#6D6D6D]">0 Poin</span>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            @endif
                                                        @else
                                                            @if ($match->is_guess == 1)
                                                                @if($match->guessing_result == 1)
                                                                <div class="flex items-center ml-2">
                                                                    <img src="{{asset('images/acvcolor.png')}}" class="h-[35px]"/>
                                                                    <div>
                                                                        <span class="block font-sans text-[10px] text-[#FFA800]">Anda dapat</span>
                                                                        <span class="block font-sans text-[12px] font-bold text-[#FFA800]">1000 Poin</span>
                                                                    </div>
                                                                </div>
                                                                @else
                                                                <div class="flex items-center ml-2">
                                                                    <img src="{{asset('images/acvgrey.png')}}" class="h-[35px]"/>
                                                                    <div>
                                                                        <span class="block font-sans text-[10px] text-[#6D6D6D]">Anda dapat</span>
                                                                        <span class="block font-sans text-[12px] font-bold text-[#6D6D6D]">0 Poin</span>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            @else
                                                                <div class="flex items-center ml-2">
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
                                                        <ul class="score">
                                                            <li class="flex items-center justify-center">
                                                                <p class="text-[#6D6D6D] font-sans text-[22px] font-bold leading-tight">{{$match->score_a}}</p>
                                                            </li>
                                                            <li class="flex items-center justify-center">
                                                                <p class="text-[#6D6D6D] font-sans text-[22px] font-bold leading-tight">{{$match->score_b}}</p>
                                                            </li>
                                                        </ul>
                                                        <?php
                                                            $datetime = date($match->match_time);
                                                            $timestamp = strtotime($datetime);
                                                            $time = $timestamp - (1 * 60 * 60);
                                                            $datetime = date("Y-m-d H:i:s", $time);

                                                            $d1 = new DateTime($currentTime);
                                                            $d2 = new DateTime($datetime);
                                                        ?>
                                                        @if ($d1 < $d2)
                                                            @if ($match->is_guess == 1)
                                                                @if($match->guessing_result == 1)
                                                                <div class="flex items-center ml-2">
                                                                    <img src="{{asset('images/acvcolor.png')}}" class="h-[35px]"/>
                                                                    <div>
                                                                        <span class="block font-sans text-[10px] text-[#FFA800]">Anda dapat</span>
                                                                        <span class="block font-sans text-[12px] font-bold text-[#FFA800]">1000 Poin</span>
                                                                    </div>
                                                                </div>
                                                                @elseif($match->guessing_result == 0)
                                                                <div class="flex items-center ml-2">
                                                                    <img src="{{asset('images/acvgrey.png')}}" class="h-[35px]"/>
                                                                    <div>
                                                                        <span class="block font-sans text-[10px] text-[#6D6D6D]">Anda dapat</span>
                                                                        <span class="block font-sans text-[12px] font-bold text-[#6D6D6D]">0 Poin</span>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            @endif
                                                        @else
                                                            <div class="flex items-center ml-2">
                                                                <img src="{{asset('images/acvgrey.png')}}" class="h-[35px]"/>
                                                                <div>
                                                                    <span class="block font-sans text-[10px] text-[#6D6D6D]">Anda dapat</span>
                                                                    <span class="block font-sans text-[12px] font-bold text-[#6D6D6D]">0 Poin</span>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                        </li>
                                        @endforeach
                                    @endauth
                                </ul>
                                <ul class="bracket bracket-4">
                                    @auth
                                        @foreach($myguess3rdplayoff as $match)
                                            <div class="absolute top-[320px] team-3rd-play-off">
                                                <li class="team-item">
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
                                                            <ul class="score">
                                                                <li class="flex items-center justify-center">
                                                                    <p class="text-[#6D6D6D] font-sans text-[22px] font-bold leading-tight">{{$match->score_a}}</p>
                                                                </li>
                                                                <li class="flex items-center justify-center">
                                                                    <p class="text-[#6D6D6D] font-sans text-[22px] font-bold leading-tight">{{$match->score_b}}</p>
                                                                </li>
                                                            </ul>
                                                            <?php
                                                                $datetime = date($match->match_time);
                                                                $timestamp = strtotime($datetime);
                                                                $time = $timestamp - (1 * 60 * 60);
                                                                $datetime = date("Y-m-d H:i:s", $time);
    
                                                                $d1 = new DateTime($currentTime);
                                                                $d2 = new DateTime($datetime);
                                                            ?>
                                                            @if ($d1 < $d2)
                                                                @if ($match->is_guess == 1)
                                                                    @if($match->guessing_result == 1)
                                                                    <div class="flex items-center ml-2">
                                                                        <img src="{{asset('images/acvcolor.png')}}" class="h-[35px]"/>
                                                                        <div>
                                                                            <span class="block font-sans text-[10px] text-[#FFA800]">Anda dapat</span>
                                                                            <span class="block font-sans text-[12px] font-bold text-[#FFA800]">1000 Poin</span>
                                                                        </div>
                                                                    </div>
                                                                    @elseif($match->guessing_result == 0)
                                                                    <div class="flex items-center ml-2">
                                                                        <img src="{{asset('images/acvgrey.png')}}" class="h-[35px]"/>
                                                                        <div>
                                                                            <span class="block font-sans text-[10px] text-[#6D6D6D]">Anda dapat</span>
                                                                            <span class="block font-sans text-[12px] font-bold text-[#6D6D6D]">0 Poin</span>
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                @endif
                                                            @else
                                                                <div class="flex items-center ml-2">
                                                                    <img src="{{asset('images/acvgrey.png')}}" class="h-[35px]"/>
                                                                    <div>
                                                                        <span class="block font-sans text-[10px] text-[#6D6D6D]">Anda dapat</span>
                                                                        <span class="block font-sans text-[12px] font-bold text-[#6D6D6D]">0 Poin</span>
                                                                    </div>
                                                                </div>
                                                            @endif
    
                                                        </div>
                                                    </div>
                                                </li>
                                            </div>
                                        @endforeach
                                        @foreach ($myguessFinal as $match)
                                            <li class="team-item">
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
                                                        <ul class="score">
                                                            <li class="flex items-center justify-center">
                                                                <p class="text-[#6D6D6D] font-sans text-[22px] font-bold leading-tight">{{$match->score_a}}</p>
                                                            </li>
                                                            <li class="flex items-center justify-center">
                                                                <p class="text-[#6D6D6D] font-sans text-[22px] font-bold leading-tight">{{$match->score_b}}</p>
                                                            </li>
                                                        </ul>
                                                        <?php
                                                            $datetime = date($match->match_time);
                                                            $timestamp = strtotime($datetime);
                                                            $time = $timestamp - (1 * 60 * 60);
                                                            $datetime = date("Y-m-d H:i:s", $time);

                                                            $d1 = new DateTime($currentTime);
                                                            $d2 = new DateTime($datetime);
                                                        ?>
                                                        @if ($d1 < $d2)
                                                            @if ($match->is_guess == 1)
                                                                @if($match->guessing_result == 1)
                                                                <div class="flex items-center ml-2">
                                                                    <img src="{{asset('images/acvcolor.png')}}" class="h-[35px]"/>
                                                                    <div>
                                                                        <span class="block font-sans text-[10px] text-[#FFA800]">Anda dapat</span>
                                                                        <span class="block font-sans text-[12px] font-bold text-[#FFA800]">1000 Poin</span>
                                                                    </div>
                                                                </div>
                                                                @elseif($match->guessing_result == 0)
                                                                <div class="flex items-center ml-2">
                                                                    <img src="{{asset('images/acvgrey.png')}}" class="h-[35px]"/>
                                                                    <div>
                                                                        <span class="block font-sans text-[10px] text-[#6D6D6D]">Anda dapat</span>
                                                                        <span class="block font-sans text-[12px] font-bold text-[#6D6D6D]">0 Poin</span>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            @endif
                                                        @else
                                                            <div class="flex items-center ml-2">
                                                                <img src="{{asset('images/acvgrey.png')}}" class="h-[35px]"/>
                                                                <div>
                                                                    <span class="block font-sans text-[10px] text-[#6D6D6D]">Anda dapat</span>
                                                                    <span class="block font-sans text-[12px] font-bold text-[#6D6D6D]">0 Poin</span>
                                                                </div>
                                                            </div>
                                                        @endif

                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    @else
                                        @foreach($match_3rdplace as $match)
                                            <div class="absolute top-[320px] team-3rd-play-off">
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
                                            </div>
                                        @endforeach
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
                                                        <ul class="score">
                                                            <li class="flex items-center justify-center">
                                                                <p class="text-[#6D6D6D] font-sans text-[22px] font-bold leading-tight">{{$match->score_a}}</p>
                                                            </li>
                                                            <li class="flex items-center justify-center">
                                                                <p class="text-[#6D6D6D] font-sans text-[22px] font-bold leading-tight">{{$match->score_b}}</p>
                                                            </li>
                                                        </ul>
                                                        <?php
                                                            $datetime = date($match->match_time);
                                                            $timestamp = strtotime($datetime);
                                                            $time = $timestamp - (1 * 60 * 60);
                                                            $datetime = date("Y-m-d H:i:s", $time);

                                                            $d1 = new DateTime($currentTime);
                                                            $d2 = new DateTime($datetime);
                                                        ?>
                                                        @if ($d1 < $d2)
                                                            @if ($match->is_guess == 1)
                                                                @if($match->guessing_result == 1)
                                                                <div class="flex items-center ml-2">
                                                                    <img src="{{asset('images/acvcolor.png')}}" class="h-[35px]"/>
                                                                    <div>
                                                                        <span class="block font-sans text-[10px] text-[#FFA800]">Anda dapat</span>
                                                                        <span class="block font-sans text-[12px] font-bold text-[#FFA800]">1000 Poin</span>
                                                                    </div>
                                                                </div>
                                                                @elseif($match->guessing_result == 0)
                                                                <div class="flex items-center ml-2">
                                                                    <img src="{{asset('images/acvgrey.png')}}" class="h-[35px]"/>
                                                                    <div>
                                                                        <span class="block font-sans text-[10px] text-[#6D6D6D]">Anda dapat</span>
                                                                        <span class="block font-sans text-[12px] font-bold text-[#6D6D6D]">0 Poin</span>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            @endif
                                                        @else
                                                            @if ($match->is_guess == 1)
                                                                @if($match->guessing_result == 1)
                                                                <div class="flex items-center ml-2">
                                                                    <img src="{{asset('images/acvcolor.png')}}" class="h-[35px]"/>
                                                                    <div>
                                                                        <span class="block font-sans text-[10px] text-[#FFA800]">Anda dapat</span>
                                                                        <span class="block font-sans text-[12px] font-bold text-[#FFA800]">1000 Poin</span>
                                                                    </div>
                                                                </div>
                                                                @else
                                                                <div class="flex items-center ml-2">
                                                                    <img src="{{asset('images/acvgrey.png')}}" class="h-[35px]"/>
                                                                    <div>
                                                                        <span class="block font-sans text-[10px] text-[#6D6D6D]">Anda dapat</span>
                                                                        <span class="block font-sans text-[12px] font-bold text-[#6D6D6D]">0 Poin</span>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            @else
                                                                <div class="flex items-center ml-2">
                                                                    <img src="{{asset('images/acvgrey.png')}}" class="h-[35px]"/>
                                                                    <div>
                                                                        <span class="block font-sans text-[10px] text-[#6D6D6D]">Anda dapat</span>
                                                                        <span class="block font-sans text-[12px] font-bold text-[#6D6D6D]">0 Poin</span>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endif
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
    </div>
@endsection
@section('main')
<main>

</main>
@endsection