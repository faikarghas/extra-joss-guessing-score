<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @yield('meta-tag')

        <!-- Fonts -->

        <!-- Styles -->
        @vite(['resources/css/app.css'])
        @vite(['resources/sass/app.scss'])

        {{-- Slick CSS --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css">

        @yield('custom-css')

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-220431952-1"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'GA-ID');
        </script>

    </head>
    <body>
        @yield('header')

        @yield('main')

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(function () {
                $('provinsi').on('change', function () {
                    axios.post('{{ route('selectcity') }}', {id: $(this).val()})
                        .then(function (response) {
                            $('#city').empty();
                            $.each(response.data, function (id, name) {
                                $('#city').append(new Option(name, id))
                            })
                        });
                });
            });
        </script>
        @vite(['resources/js/app.ts'])


        </body>
</html>


