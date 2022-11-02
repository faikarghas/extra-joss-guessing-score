<nav class="fixed sm:absolute z-30 w-full top-0 left-0 bg-black md:bg-transparent px-5 sm:px-6 py-4 xl:px-[100px] lg:pt-[25px]">
    <div class="container flex flex-wrap justify-between items-center mx-auto">
    <a href="{{route('home')}}" class="flex items-center">
        <img src="{{asset('/images/logo.png')}}" class="mr-3 h-[53px] sm:h-[98px]" alt="Extrajoss Logo">
    </a>

    <ul class="m-0 px-6 py-1 flex bg-[#FFEC00] rounded-3xl md:hidden">
        @guest
        <li class="log flex items-center list-none cursor-pointer">
            <img alt="icon user" src="{{asset('images/user_black.png')}}" class="w-[14px] mr-2 pb-1"/>
            <a href="{{route('masuk')}}" class="font-head text-black pt-[2px] leading-[14px] md:text-[18px] lg:text-[20px] md:leading-[18px]">MASUK</a></li>
        <li class="flex items-center list-none font-head text-black text-[20px] mx-2">|</li>
        <li class="reg flex items-center list-none cursor-pointer"><a href="{{route('daftar')}}" class="font-head text-black pt-[2px] md:text-[18px] lg:text-[20px] leading-[14px] lg:leading-[20px]">DAFTAR</a></li>
        @endguest
        @auth
        {{-- <li class="flex items-center list-none cursor-pointer">
            <img alt="icon user" src="{{asset('images/user.png')}}" class="w-[14px] mr-2 pb-1"/>
            <a href="{{route('profil')}}" class="font-head text-[#FFEC00] text-[20px] leading-[18px]">{{ Auth::user()->email }}</a></li>
        <li class="flex items-center list-none font-head text-[#FFEC00] text-[20px] mx-2">|</li> --}}
        <li class="flex items-center list-none cursor-pointer"><a href="{{ route('logout') }}" class="font-head text-[#FFEC00] md:text-[18px] lg:text-[20px] leading-[20px]">LOGOUT</a></li>
        @endauth
    </ul>

    <div id="menu-hamburger" class="block md:hidden">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div class="hidden w-full md:block md:w-auto pb-8" id="navbar-default">
        <ul class="flex flex-col px- md:flex-row md:space-x-2 lg:space-x-4 md:mt-0 ">
            <li class="flex items-center">
                <a href="{{route('home')}}" class="{{ Request::is('/') ? 'text-black' : 'text-[#FF0000]' }} leading-[20px] block pr-4 pl-3 font-head md:text-[18px] lg:text-[24px]" aria-current="page">BERANDA</a>
            </li>
            <li class="flex items-center">
                <a href="{{route('mekanisme')}}" class="{{ Request::is('mekanisme') ? 'text-black' : 'text-[#FF0000]' }} leading-[20px] block pr-4 pl-3 font-head md:text-[18px] lg:text-[24px]" aria-current="page">MEKANISME</a>
            </li>
            <li class="flex items-center">
                <a href="{{route('hadiah')}}" class="{{ Request::is('hadiah') ? 'text-black' : 'text-[#FF0000]' }} leading-[20px] block pr-4 pl-3 font-head md:text-[18px] lg:text-[24px]" aria-current="page">HADIAH</a>
            </li>
            <li class="flex items-center">
                <a href="{{route('belanja')}}" class="{{ Request::is('belanja') ? 'text-black' : 'text-[#FF0000]' }} leading-[20px] block pr-4 pl-3 font-head md:text-[18px] lg:text-[24px]" aria-current="page">BELANJA</a>
            </li>
            <li class="flex items-center">
                <a href="{{route('hasilKlasemen')}}" class="{{ Request::is('hasil-klasemen') ? 'text-black' : 'text-[#FF0000]' }} leading-[20px] block pr-4 pl-3 font-head md:text-[18px] lg:text-[24px]" aria-current="page">Hasil Klasemen</a>
            </li>
            <li>
                <ul class="m-0 px-6 py-1 flex bg-black rounded-3xl">
                    @guest
                    <li class="log flex items-center list-none cursor-pointer">
                        <img alt="icon user" src="{{asset('images/user.png')}}" class="w-[14px] mr-2 pb-1"/>
                        <a href="{{route('masuk')}}" class="font-head text-[#FFEC00] md:text-[18px] lg:text-[20px] leading-[18px]">MASUK</a></li>
                    <li class="flex items-center list-none font-head text-[#FFEC00] text-[20px] mx-2">|</li>
                    <li class="reg flex items-center list-none cursor-pointer"><a href="{{route('daftar')}}" class="font-head text-[#FFEC00] md:text-[18px] lg:text-[20px] leading-[20px]">DAFTAR</a></li>
                    @endguest
                    @auth
                    <li class="flex items-center list-none cursor-pointer">
                        <img alt="icon user" src="{{asset('images/user.png')}}" class="w-[14px] mr-2 pb-1"/>
                        <a href="{{route('profil')}}" class="font-head text-[#FFEC00] text-[20px] leading-[18px]">{{ Auth::user()->username }}</a></li>
                    <li class="flex items-center list-none font-head text-[#FFEC00] text-[20px] mx-2">|</li>
                    <li class="flex items-center list-none cursor-pointer"><a href="{{ route('logout') }}" class="font-head text-[#FFEC00] md:text-[18px] lg:text-[20px] leading-[20px]">LOGOUT</a></li>
                    @endauth
                </ul>
            </li>
        </ul>
    </div>
    </div>
</nav>

<div class="hidden menu-mobile fixed bg-[#FFEC00] z-50 top-0 left-0 w-full h-full bg-no-repeat bg-cover bg-center" style="background-image: url({{asset('/images/bg-yellow.png')}})">
    <div class="close absolute top-[20px] right-[20px]">
        <div class="">
            <img src="{{asset('/images/close-w.png')}}" />
        </div>
    </div>
    <ul class="flex flex-col items-center justify-center h-full pb-40">
        <li class="flex items-center mb-24">
            <img src="{{asset('/images/logo.png')}}" class="h-[84px]" alt="Extrajoss Logo">
        </li>
        <li class="flex items-center mb-6">
            <a href="{{route('home')}}" class="{{ Request::is('/') ? 'text-black' : 'text-[#FF0000]' }} leading-[35px] block font-head text-[40px]" aria-current="page">BERANDA</a>
        </li>
        <li class="flex items-center mb-6">
            <a href="{{route('mekanisme')}}" class="{{ Request::is('mekanisme') ? 'text-black' : 'text-[#FF0000]' }} leading-[35px] block font-head text-[40px]" aria-current="page">MEKANISME</a>
        </li>
        <li class="flex items-center mb-6">
            <a href="{{route('hadiah')}}" class="{{ Request::is('hadiah') ? 'text-black' : 'text-[#FF0000]' }} leading-[35px] block font-head text-[40px]" aria-current="page">HADIAH</a>
        </li>
        <li class="flex items-center mb-6">
            <a href="{{route('belanja')}}" class="{{ Request::is('belanja') ? 'text-black' : 'text-[#FF0000]' }} leading-[35px] block font-head text-[40px]" aria-current="page">BELANJA</a>
        </li>
        <li class="flex items-center">
            <a href="{{route('hasilKlasemen')}}" class="{{ Request::is('hasil-klasemen') ? 'text-black' : 'text-[#FF0000]' }} leading-[20px] block font-head text-[40px]" aria-current="page">Hasil Klasemen</a>
        </li>
    </ul>
</div>