<span class="block mb-2.5 text-[16px] font-sans text-[#acacac]">Group {{$match->group}} • {{$match->match_time}}</span>
<div class="flex flex-wrap">
    @if ($match->team1 !== 'NA')
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
    @else
    <ul class="basis-1/2 border-r-[1px] border-[#383838]">
        <li class="mb-2 flex items-center">
            <p class="text-white font-sans ml-1.5 text-[15px] leading-tight">NA</p>
        </li>
        <li class="flex items-center">
            <p class="text-white font-sans ml-1.5 text-[15px] leading-tight">NA</p>
        </li>
    </ul>
    @endif
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
            <div data-idMatch="{{$match->id_match}}" data-flag1="{{$match->flag_team1}}" data-flag2="{{$match->flag_team2}}" data-team1={{$match->team1}} data-team2={{$match->team2}} class="btn-tebak bg-[#FF0000] text-white text-[12px] rounded-2xl py-1 px-2 w-[100px] text-center cursor-pointer">Tebak Skor</div>
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
            <div data-idMatch="{{$match->id_match}}" data-skor="{{$match->guessing_score_a}},{{$match->guessing_score_b}}" data-flag1={{$match->flag_team1}} data-flag2={{$match->flag_team2}} data-team1={{$match->team1}} data-team2={{$match->team2}} class="btn-tebak cursor-pointer bg-[#0085CF] text-white text-[12px] rounded-2xl py-1 px-2 w-[94px] text-center">Edit Skor</div>
            @endif
        @else
            {{-- sudah expire dan sudah tebak skor --}}
            @if ($match->team1 !== 'NA')
                @if ($match->is_guess == 1)
                    @if($match->guessing_result == 1)
                        <ul class="score">
                            <li class="flex items-center">
                                <p class="text-[#6D6D6D] font-sans ml-4 text-[22px] font-bold leading-tight">{{$match->guessing_score_a}}</p>
                            </li>
                            <li class="flex items-center">
                                <p class="text-[#6D6D6D] font-sans ml-4 text-[22px] font-bold leading-tight">{{$match->guessing_score_b}}</p>
                            </li>
                        </ul>
                        <div class="flex items-center ml-4">
                            <img src="{{asset('images/acvcolor.png')}}" class="h-[35px]"/>
                            <div>
                                <span class="block font-sans text-[10px] text-[#FFA800]">Anda dapat</span>
                                <span class="block font-sans text-[12px] font-bold text-[#FFA800]">1000 Poin</span>
                            </div>
                        </div>
                    @else
                    {{-- sudah expire, sudah tebak skor dan hasil pertaningan belum ada--}}
                    <ul class="score">
                        <li class="flex items-center">
                            <p class="text-[#6D6D6D] font-sans mr-4 text-[22px] font-bold leading-tight">{{$match->guessing_score_a}}</p>
                        </li>
                        <li class="flex items-center">
                            <p class="text-[#6D6D6D] font-sans mr-4 text-[22px] font-bold leading-tight">{{$match->guessing_score_b}}</p>
                        </li>
                    </ul>
                    <div class="bg-[#6D6D6D] text-white text-[12px] rounded-2xl py-1 px-2 w-[94px] text-center">Edit Skor</div>
                    @endif
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
        @endif
    </div>
</div>