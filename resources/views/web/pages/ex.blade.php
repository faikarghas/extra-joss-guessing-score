@extends('web/components/layout.index')
@section('meta-tag')
<title></title>
<meta name="description" content="meta description">
@endsection
@section('header')
    <header>
        <img src="{{asset('/images/banner.jpg')}}" class="w-full h-full"/>
    </header>
@endsection
@section('main')
<main>
    <section class="bg-black pt-14 pb-32 relative px-8">
        <div class="text-center">
            <h3 class="text-[60px] text-white font-head mb-8">Hasil Terakhir</h3>
        </div>
        <div class="flex flex-wrap flex-row justify-center items-center gap-10">
            <div class="">
                <div class="text-center mb-8">
                    <span class="text-[#FFFFFF]">Final Score</span>
                </div>
                <div class="flex flex-wrap flex-row">
                    <div class="text-white flex flex-row">
                        <div class="text-center mr-6">
                            <div class="h-[78px] mb-4">
                                <img src="{{asset('/images/countries/equador.png')}}" class="h-[68px] md:h-[77px]"/>
                            </div>
                            <span class="font-sans text-[16px] font-bold">Ecuador</span>
                        </div>
                        <div class="">
                            <div class="h-[77px] flex items-center">
                                <h6 class="text-[40px] md:text-[60px] font-sans leading-[45px]">0</h6>
                            </div>
                        </div>
                    </div>
                    <div class="text-white mx-4 md:mx-6">
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
                            <div class="h-[78px] mb-4">
                                <img src="{{asset('/images/countries/qatar.png')}}" class="h-[68px] md:h-[77px]"/>
                            </div>
                            <span class="font-sans text-[16px] font-bold">Qatar</span>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="text-white">|</div> --}}
        </div>
        <img src="{{asset("/images/lap2.png")}}" class="w-[1000px] absolute bottom-[-12%] md:bottom-[-24%] left-[50%] translate-x-[-50%]"/>
    </section>
    <section class="bg-top bg-cover bg-no-repeat pt-32 px-8" style="background-image: url(/images/bg-yellow.png)">>
        <div class="flex items-center flex-col mb-20">
            <h2 class="text-black font-head text-[60px] text-center mb-6">IKUT KICKOFF QUIZ UNTUK NAMBAH POIN!</h2>
            <div class="bg-black py-1.5 rounded-2xl w-[249px] font-sans text-[14px] text-[#FCEF0A] text-center">Lihat Quiz</div>
        </div>
        <div class="mb-8">
            <h2 class="text-black font-head text-[60px] text-center mb-2 uppercase leading-[50px]">Tebak Skor</h2>
            <h5 class="text-black font-head text-[20px] text-center uppercase">MINGGU KE 1</h5>
        </div>
        {{-- TEBAK SCORE  --}}
        <div class="flex flex-row gap-2">
            <div class="basis-1/2 flex flex-wrap bg-[#202124]">
                @foreach ($matches as $key => $match)
                @if ($key < 8)
                <div class="basis-1/2 border-b-[1px] border-r-[1px] border-[#383838] px-4 py-6">
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
            <div class="basis-1/2 flex flex-wrap bg-[#202124]">
                @foreach ($matches as $key => $match)
                @if ($key > 8)
                <div class="basis-1/2 border-b-[1px] border-r-[1px] border-[#383838] px-4 py-6">
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

    <div class="modal-form hidden flex-wrap bg-black w-[400px] md:w-[600px] p-14 fixed top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%]">
    </div>
</main>
@endsection