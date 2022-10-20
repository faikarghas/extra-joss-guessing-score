@extends('web/components/layout.index')
@section('meta-tag')
<title></title>
<meta name="description" content="meta description">
@endsection
@section('header')
@endsection
@section('main')
<main>
    <div class="modal-register w-full  bg-[#FFEC00] px-14 pt-20 pb-6">
        <div class="bg-white flex flex-wrap py-14 px-20 relative justify-between">
            <div class="close-register absolute top-[15px] right-[15px] cursor-pointer">
                <a href="{{route('ex')}}" class="block w-[44px] h-[44px] bg-black rounded-full flex items-center justify-center">
                    <img src="{{asset('/images/close-w.png')}}" />
                </a>
            </div>
            <div class="basis-full flex justify-between mb-8">
                <h2 class="font-head text-[60px] leading-[54px]">DAFTAR</h2>
                <h2 class="font-head text-[60px] text-[#FFA800] flex leading-[54px] items-center">DAPATKAN <img class="mx-2 object-contain h-[36px]" src="{{asset('/images/acv2.png')}}" />  60 Poin AWAL!</h2>
            </div>
            <div class="basis-full relative">
                <form class="flex flex-wrap justify-between">
                    <div class="basis-[48%] flex flex-wrap justify-between">
                        <div class="self-start relative z-0 mb-6 w-full group basis-[48%]">
                            <label for="nama" class="block mb-2 text-sm font-medium text-[#A0A0A0] dark:text-gray-300">NAMA*</label>
                            <input id="nama" type="text" name="nama" class="font-sans block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2  focus:outline-none focus:ring-0 focus:border-black-600 peer" placeholder="" required="">
                        </div>
                        <div class="self-start relative z-0 mb-6 w-full group basis-[48%]">
                            <label for="username" class="block mb-2 text-sm font-medium text-[#A0A0A0] dark:text-gray-300">USERNAME*</label>
                            <input id="username" type="text" name="username" class="font-sans block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 focus:outline-none focus:ring-0 focus:border-black-600 peer" placeholder="" required="">
                        </div>
                        <div class="self-start relative z-0 mb-6 w-full group basis-[48%]">
                            <label for="instagram" class="block mb-2 text-sm font-medium text-[#A0A0A0] dark:text-gray-300">AKUN INSTAGRAM*</label>
                            <input id="instagram" type="text" name="instagram" class="font-sans block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2  focus:outline-none focus:ring-0 focus:border-black-600 peer" placeholder="@" required="">
                        </div>
                        <div class="self-start relative z-0 mb-6 w-full group basis-[48%]">
                            <label for="email" class="block mb-2 text-sm font-medium text-[#A0A0A0] dark:text-gray-300">ALAMAT EMAIL*</label>
                            <input id="email" type="text" name="email" class="font-sans block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 focus:outline-none focus:ring-0 focus:border-black-600 peer" placeholder="" required="">
                        </div>
                        <div class="self-start relative z-0 mb-6 w-full group basis-full">
                            <label for="phone" class="block mb-2 text-sm font-medium text-[#A0A0A0] dark:text-gray-300">NO HANDPHONE*</label>
                            <input id="phone" type="tel" name="phone" class="font-sans block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 focus:outline-none focus:ring-0 focus:border-black-600 peer" placeholder="" required="">
                        </div>
                        <div class="self-start relative z-0 mb-6 w-full group basis-full">
                            <label for="nik" class="block mb-2 text-sm font-medium text-[#A0A0A0] dark:text-gray-300">NO IDENTITAS KEPENDUDUKAN*</label>
                            <input id="nik" type="text" name="nik" class="font-sans block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 focus:outline-none focus:ring-0 focus:border-black-600 peer" placeholder="" required="">
                        </div>
                    </div>
                    <div class="basis-[48%] flex flex-wrap justify-between">
                        <div class="self-start relative z-0 mb-6 w-full group basis-full">
                            <label for="password" class="block mb-2 text-sm font-medium text-[#A0A0A0] dark:text-gray-300">KOTA*</label>
                            <select id="countries" class="font-sans block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2  focus:outline-none focus:ring-0 focus:border-black-600 peer">
                                <option>United States</option>
                                <option>Canada</option>
                                <option>France</option>
                                <option>Germany</option>
                              </select>
                        </div>
                        <div class="self-start relative z-0 mb-6 w-full group basis-full">
                            <label for="password" class="block mb-2 text-sm font-medium text-[#A0A0A0] dark:text-gray-300">KECAMATAN*</label>
                            <select id="countries" class="font-sans block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2  focus:outline-none focus:ring-0 focus:border-black-600 peer">
                                <option>United States</option>
                                <option>Canada</option>
                                <option>France</option>
                                <option>Germany</option>
                              </select>
                        </div>
                        <div class="self-start relative z-0 mb-6 w-full group basis-full">
                            <label for="password" class="block mb-2 text-sm font-medium text-[#A0A0A0] dark:text-gray-300">ALAMAT RUMAH*</label>
                            <input type="text" name="floating_password" class="font-sans block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 focus:outline-none focus:ring-0 focus:border-black-600 peer" placeholder="" required="">
                        </div>
                        <div class="self-start relative z-0 mb-6 w-full group basis-[48%]">
                            <label for="password" class="block mb-2 text-sm font-medium text-[#A0A0A0] dark:text-gray-300">UKURAN JERSEY*</label>
                            <input type="text" name="floating_password" class="font-sans block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 focus:outline-none focus:ring-0 focus:border-black-600 peer" placeholder="" required="">
                        </div>
                        <div class="self-start relative z-0 mb-6 w-full group basis-[48%]">
                            <label for="password" class="block mb-2 text-sm font-medium text-[#A0A0A0] dark:text-gray-300">UKURAN SEPATU*</label>
                            <input type="text" name="floating_password" class="font-sans block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 focus:outline-none focus:ring-0 focus:border-black-600 peer" placeholder="" required="">
                        </div>
                    </div>
                  <button type="submit" class="bg-gray-200 text-gray-600 p-4 w-full font-sans">KIRIM</button>
                </form>
            </div>
        </div>
        <div class="pb-14 pt-10">
            <img alt="logo extra joss" class="m-auto mb-2" src="{{asset('/images/logo.png')}}"/>
            <p class="font-sans text-center text-[10px]">Copyright © 2022 ExtraJoss</p>
        </div>
    </div>
</main>
@endsection