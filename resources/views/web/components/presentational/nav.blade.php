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
                <a href="{{route('home')}}" class="{{ Request::is('/') ? 'text-black' : 'text-[#FF0000]' }} leading-[20px] block pr-4 pl-3 font-head text-[24px]" aria-current="page">BERANDA</a>
            </li>
            <li class="flex items-center">
                <a href="{{route('mekanisme')}}" class="{{ Request::is('mekanisme') ? 'text-black' : 'text-[#FF0000]' }} leading-[20px] block pr-4 pl-3 font-head text-[24px]" aria-current="page">MEKANISME</a>
            </li>
            <li class="flex items-center">
                <a href="{{route('hadiah')}}" class="{{ Request::is('hadiah') ? 'text-black' : 'text-[#FF0000]' }} leading-[20px] block pr-4 pl-3 font-head text-[24px]" aria-current="page">HADIAH</a>
            </li>
            <li class="flex items-center">
                <a href="{{route('belanja')}}" class="{{ Request::is('belanja') ? 'text-black' : 'text-[#FF0000]' }} leading-[20px] block pr-4 pl-3 font-head text-[24px]" aria-current="page">BELANJA</a>
            </li>
            <li>
                <ul class="m-0 px-6 py-1 flex bg-black rounded-3xl">
                    @guest
                    <li class="log flex items-center list-none cursor-pointer">
                        <img alt="icon user" src="{{asset('images/user.png')}}" class="w-[14px] mr-2 pb-1"/>
                        <a href="{{route('masuk')}}" class="font-head text-[#FFEC00] text-[20px] leading-[18px]">MASUK</a></li>
                    <li class="flex items-center list-none font-head text-[#FFEC00] text-[20px] mx-2">|</li>
                    <li class="reg flex items-center list-none cursor-pointer"><a href="{{route('daftar')}}" class="font-head text-[#FFEC00] text-[20px] leading-[20px]">DAFTAR</a></li>
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