@extends('web/components/layout.index')
@section('meta-tag')
<title></title>
<meta name="description" content="meta description">
@endsection
@section('header')
@endsection
@section('main')
<main>
@auth
      Login
@endauth

<a href="{{ url('login/google') }}">
<img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png">
</a>

<a href="{{ url('/login/facebook') }}" class="btn btn-facebook"><i class="fa fa-facebook"></i> Facebook</a>
</div>


</main>
@endsection