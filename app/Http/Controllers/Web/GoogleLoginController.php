<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\Guessing;
use App\Models\User;
use App\Models\Fmatch;

class GoogleLoginController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function callback()
    {
        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();

            if ( $finduser ) {

                Auth::login($finduser);

                return redirect()->intended('/');

            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'point_1' => 60,
                    'total_point' => 60,
                    'password' => 'dummypass'// you can change auto generate password here and send it via email but you need to add checking that the user need to change the password for security reasons
                ]);

                $lasId = $newUser->id;
                $matches = Fmatch::join('countries as c1', 'fmatches.id_team_a', '=', 'c1.id')
                ->join('countries as c2', 'fmatches.id_team_b', '=', 'c2.id')
                ->join('rounds as c3', 'fmatches.round', '=', 'c3.id')
                ->select("fmatches.id","c1.name AS team1", "c2.name AS team2","score_a","score_b","stadium","match_time","expired_time","c3.title as round","c1.flag_image as flag_team1","c2.flag_image as flag_team2","match_status")
                ->get();

                foreach ($matches as $key => $match) {
                    Guessing::updateOrCreate([
                        'id_user'   => $lasId,
                        'id_match'  => $match->id,
                    ],[
                        'guessing_score_a' => 0,
                        'guessing_score_b' => 0,
                    ]);
                }

                Auth::login($newUser);

                return redirect()->intended('/');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
