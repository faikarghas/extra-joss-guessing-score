@extends('web/components/layout.index')
@section('meta-tag')
<title></title>
<meta name="description" content="meta description">
@endsection
@section('header')
@endsection
@section('main')
<main>
    <div class="grid gap-3 grid-cols-2">
        @if (count($myguess) > 0)
            <form action="{{route('sous',$myguess[0]->id_match)}}" method="post">
                @csrf
                {{$myguess[0]->team1}}  vs {{$myguess[0]->team2}}
                <input type="number" name="guess_score_a"
                value="{{$myguess[0]->guessing_score_a}}"></input>

                <input type="number" name="guess_score_b"
                value="{{$myguess[0]->guessing_score_b}}"></input>
                <button type="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Blue</button>
                </div>
            </form>
        @else
            <form action="{{route('sous',$match[0]->id)}}" method="post">
                @csrf
                {{$match[0]->team1}}  vs {{$match[0]->team2}}
                <input type="number" name="guess_score_a"
                value=""></input>

                <input type="number" name="guess_score_b"
                value=""></input>
                <button type="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Blue</button>
                </div>
            </form>
        @endif

    </div>
</main>
@endsection