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
      <p>Name: {{$userDetail['name']}}</p>
      <p>Email: {{$userDetail['email']}}</p>
      <p>Point: {{$userDetail['point'] ? $userDetail['point'] : 0}}</p>
      Login
      @endauth

      @guest
      <a href="{{ url('login/google') }}">
        <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png">
      </a>

      Not login
      @endguest

    <div class="container mx-auto">
      <div class="grid gap-3 grid-cols-2">

        @auth
        <div class="overflow-x-auto relative">
          <h3>Matchday 1</h3>
          <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        Team 1
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Team 2
                    </th>
                    <th scope="col" class="py-3 px-6">
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($matches as $match)
                  <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                      <td class="py-4 px-6">
                        {{$match->team1}}
                      </td>
                      <td class="py-4 px-6">
                        {{$match->team2}}
                      </td>
                      <td class="py-4 px-6">
                        <a href="{{route('gs',$match->id)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Guess</a>
                    </td>
                  </tr>
                @endforeach
            </tbody>
          </table>
        </div>

        <div class="overflow-x-auto relative">
          <h3>My Guess</h3>
          <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                  <tr>
                      <th scope="col" class="py-3 px-6">
                          Name
                      </th>
                      <th scope="col" class="py-3 px-6">
                          Team 1
                      </th>
                      <th scope="col" class="py-3 px-6">
                          Team 2
                      </th>
                      <th scope="col" class="py-3 px-6">
                          Score a
                      </th>
                      <th scope="col" class="py-3 px-6">
                          Score b
                      </th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($myguess as $mygues)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$mygues->name}}
                        </th>
                        <td class="py-4 px-6">
                          {{$mygues->team1}}
                        </td>
                        <td class="py-4 px-6">
                          {{$mygues->team2}}
                        </td>
                        <td class="py-4 px-6">
                          {{$mygues->guessing_score_a}}
                        </td>
                        <td class="py-4 px-6">
                          {{$mygues->guessing_score_b}}
                        </td>
                    </tr>
                  @endforeach
              </tbody>
          </table>
        </div>
        @endauth

        <div class="overflow-x-auto relative">
          <h3>Standings</h3>
          <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                  <tr>
                      <th scope="col" class="py-3 px-6">
                          Name
                      </th>
                      <th scope="col" class="py-3 px-6">
                          Point
                      </th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($klasemens as $klasemen)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$klasemen->name}}
                        </th>
                        <td class="py-4 px-6">
                          {{$klasemen->total_point}}
                        </td>
                    </tr>
                  @endforeach
              </tbody>
          </table>
        </div>

      </div>

      {{-- <div class="grid gap-3 grid-cols-2">
        <div>
          <form action="{{url('guess-score')}}" method="post">
          @csrf
          @foreach ($matches as $match)
              <div class="">
                  {{$match->team1}}  vs {{$match->team2}}

                    @if (count($myguess) !== 0 )
                      @foreach ($myguess as $guess)
                        @if ($guess->guessing_score_a !== NULL && $guess->guessing_score_b !== NULL)
                            <input type="number" name="guess_scorea_{{$match->id}}"
                            value="{{$guess->guessing_score_a}}"
                            ></input>
                            <input type="number" name="guess_scoreb_{{$match->id}}"
                            value="{{$guess->guessing_score_b}}"
                            ></input>
                        @endif
                      @endforeach
                    @endif
                    <input type="number" name="guess_scorea_{{$match->id}}"
                    value=""
                    ></input>
                    <input type="number" name="guess_scoreb_{{$match->id}}"
                    value=""
                    ></input>

                    <button type="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Blue</button>
                </div>
          @endforeach
        </form>

        </div>
      </div> --}}
    </div>

</main>
@endsection