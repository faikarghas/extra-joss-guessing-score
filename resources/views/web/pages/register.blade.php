@extends('web/components/layout.index')
@section('meta-tag')
<title></title>
<meta name="description" content="meta description">
@endsection
@section('header')
@endsection
@section('main')
<main>
    <div class="modal-register w-full  bg-[#FFEC00] px-9 lg:px-14 pt-9 lg:pt-20 pb-6">
        <div class="bg-white flex flex-wrap py-14 px-4 lg:px-20 relative justify-between">
            <div class="close-register absolute top-[-22px] right-[-22px] lg:top-[15px] lg:right-[15px] cursor-pointer">
                <a href="{{route('home')}}" class="w-[44px] h-[44px] bg-black rounded-full flex items-center justify-center">
                    <img src="{{asset('/images/close-w.png')}}" />
                </a>
            </div>
            <div class="basis-full flex flex-col lg:flex-row justify-between mb-8">
                <h2 class="font-head text-[60px] leading-[54px]">DAFTAR</h2>
                <h2 class="font-head text-[25px] lg:text-[60px] text-[#FFA800] flex leading-[54px] items-center">DAPATKAN <img class="mx-2 object-contain h-[36px]" src="{{asset('/images/acv2.png')}}" />  60 Poin AWAL!</h2>
            </div>
            <div class="basis-full relative">
                <form class="flex flex-wrap justify-between" method="POST" action="{{ route('storeRegister') }}">
                @csrf
                    <div class="basis-full lg:basis-[48%] flex flex-wrap justify-between">
                        <div class="self-start relative z-0 mb-6 w-full group basis-full lg:basis-[48%]">
                            <label for="nama" class="block mb-2 text-sm font-medium text-[#A0A0A0] dark:text-gray-300">NAMA*</label>
                            <input id="nama" type="text" name="name" class="required font-sans block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2  focus:outline-none focus:ring-0 focus:border-black-600 peer  @error('name') is-invalid @enderror" placeholder="" required value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <div class="p-1 mt-2 text-[12px] text-red-700  role="alert">
                                <span class="font-medium">{{ $errors->first('name') }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="self-start relative z-0 mb-6 w-full group basis-full lg:basis-[48%]">
                            <label for="email" class="block mb-2 text-sm font-medium text-[#A0A0A0] dark:text-gray-300">ALAMAT EMAIL*</label>
                            <input id="email" type="email" name="email" class="required font-sans block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 focus:outline-none focus:ring-0 focus:border-black-600 peer  @error('email') is-invalid @enderror" placeholder="user@example.net" required value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <div class="p-1 mt-2 text-[12px] text-red-700  role="alert">
                                <span class="font-medium">{{ $errors->first('email') }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="self-start relative z-0 mb-6 w-full group basis-full lg:basis-[48%]">
                            <label for="username" class="block mb-2 text-sm font-medium text-[#A0A0A0] dark:text-gray-300">USERNAME*</label>
                            <input id="username" type="text" name="username" class="required font-sans block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 focus:outline-none focus:ring-0 focus:border-black-600 peer  @error('username') is-invalid @enderror" placeholder="" required value="{{ old('username') }}" >
                            @if ($errors->has('username'))
                                <div class="p-1 mt-2 text-[12px] text-red-700  role="alert">
                                <span class="font-medium">{{ $errors->first('username') }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="self-start relative z-0 mb-6 w-full group basis-full lg:basis-[48%]">
                            <label for="password" class="block mb-2 text-sm font-medium text-[#A0A0A0] dark:text-gray-300">PASSWORD*</label>
                            <input id="password" type="password" name="password" class="required font-sans block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 focus:outline-none focus:ring-0 focus:border-black-600 peer" placeholder="" required>
                            @if ($errors->has('password'))
                                <div class="p-1 mt-2 text-[12px] text-red-700  role="alert">
                                <span class="font-medium">{{ $errors->first('password') }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="self-start relative z-0 mb-6 w-full group basis-full">
                            <label for="instagram" class="block mb-2 text-sm font-medium text-[#A0A0A0] dark:text-gray-300">AKUN INSTAGRAM</label>
                            <input id="instagram" type="text" name="account_instagram" class="font-sans block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2  focus:outline-none focus:ring-0 focus:border-black-600 peer" placeholder="@">
                        </div>
                        <div class="self-start relative z-0 mb-6 w-full group basis-full">
                            <label for="phone" class="block mb-2 text-sm font-medium text-[#A0A0A0] dark:text-gray-300">NO HANDPHONE*</label>
                            <input id="phone" type="tel" name="phone" class="required font-sans block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 focus:outline-none focus:ring-0 focus:border-black-600 peer" placeholder="" required value="{{ old('phone') }}">
                            @if ($errors->has('phone'))
                                <div class="p-1 mt-2 text-[12px] text-red-700  role="alert">
                                <span class="font-medium">{{ $errors->first('phone') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="basis-full lg:basis-[48%] flex flex-wrap justify-between">
                        <div class="self-start relative z-0 mb-6 w-full group basis-full">
                            <label for="password" class="block mb-2 text-sm font-medium text-[#A0A0A0] dark:text-gray-300">KOTA*</label>
                            <select class="required font-sans block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2  focus:outline-none focus:ring-0 focus:border-black-600 peer" name="city" id="provinsi" required value="{{ old('provinsi') }}">
                                <option value="">Pilih Provinsi</option>
                                @foreach ($province as $row )
                                <option value="{{ $row->id }}">{{ $row->name }}</option>    
                                @endforeach
                              </select>
                              @if ($errors->has('provinsi'))
                                <div class="p-1 mt-2 text-[12px] text-red-700  role="alert">
                                <span class="font-medium">{{ $errors->first('provinsi') }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="self-start relative z-0 mb-6 w-full group basis-full">
                            <label for="password" class="block mb-2 text-sm font-medium text-[#A0A0A0] dark:text-gray-300">KECAMATAN*</label>
                              <select name="city" id="city" class="required font-sans block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2  focus:outline-none focus:ring-0 focus:border-black-600 peer" required>
                                <option value="">Pilih Kota</option>
                            </select>
                            @if ($errors->has('city'))
                                <div class="p-1 mt-2 text-[12px] text-red-700  role="alert">
                                <span class="font-medium">{{ $errors->first('city') }}</span>
                                </div>
                            @endif
                            
                        </div>
                        <div class="self-start relative z-0 mb-6 w-full group basis-full">
                            <label for="password" class="block mb-2 text-sm font-medium text-[#A0A0A0] dark:text-gray-300">ALAMAT RUMAH*</label>
                            <input type="text" name="address" class="required font-sans block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 focus:outline-none focus:ring-0 focus:border-black-600 peer" placeholder="" required value="{{ old('address') }}">
                            @if ($errors->has('address'))
                                <div class="p-1 mt-2 text-[12px] text-red-700  role="alert">
                                <span class="font-medium">{{ $errors->first('address') }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="self-start relative z-0 mb-6 w-full group basis-full lg:basis-[48%]">
                            <label for="password" class="block mb-2 text-sm font-medium text-[#A0A0A0] dark:text-gray-300">UKURAN JERSEY*</label>
                            <input type="text" name="size_jersey" class="required font-sans block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 focus:outline-none focus:ring-0 focus:border-black-600 peer" placeholder="S, M, L, XL, XXL" required value="{{ old('size_jersey') }}">
                            @if ($errors->has('size_jersey'))
                                <div class="p-1 mt-2 text-[12px] text-red-700  role="alert">
                                <span class="font-medium">{{ $errors->first('size_jersey') }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="self-start relative z-0 mb-6 w-full group basis-full lg:basis-[48%]">
                            <label for="password" class="block mb-2 text-sm font-medium text-[#A0A0A0] dark:text-gray-300">UKURAN SEPATU*</label>
                            <input type="text" name="size_sepatu" class="required font-sans block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 focus:outline-none focus:ring-0 focus:border-black-600 peer" placeholder="36, 37, 38, 39, 40, 41, 42, 43, 44, 45" required value="{{ old('size_sepatu') }}">
                            @if ($errors->has('size_sepatu'))
                                <div class="p-1 mt-2 text-[12px] text-red-700  role="alert">
                                <span class="font-medium">{{ $errors->first('size_sepatu') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="basis-full">
                        <div class="self-start relative z-0 mb-6 w-full group basis-full">
                            <label for="nik" class="block mb-2 text-sm font-medium text-[#A0A0A0] dark:text-gray-300">NO IDENTITAS KEPENDUDUKAN*</label>
                            <input id="nik" type="text" name="nik" class="required font-sans block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 focus:outline-none focus:ring-0 focus:border-black-600 peer" placeholder="" required value="{{ old('nik') }}">
                            @if ($errors->has('nik'))
                                <div class="p-1 mt-2 text-[12px] text-red-700  role="alert">
                                <span class="font-medium">{{ $errors->first('nik') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                  <button type="submit" class="bg-gray-200 text-gray-600 p-4 w-full font-sans">KIRIM</button>
                    @if($message = Session::get('email_duplicate'))
                        <div class="p-4 mt-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                            <span class="font-medium">{{$message}}</span>
                        </div>
                    @endif
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

<script>

</script>