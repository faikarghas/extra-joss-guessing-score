<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    
    /**
     * Login username to be used by the controller.
     *
     * @var string
     */
    protected $username;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {

        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $checkEmail = User::where('email',$input['email'])->get();

        if (count($checkEmail) > 0) {
            if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))){
                if (auth()->user()->role == 'admin') {
                    return redirect()->route('dashboard.index');
                }else{
                    return redirect()->route('home');
                }
            }else{
                return redirect()->route('masuk')
                    ->with('error_password','Password Salah.');
            }
        } else {
            return redirect()->route('masuk')
                ->with('error_email','Email belum terdaftar.');
        }

    }
    /**
     * Get username property.
     *
     * @return string
     */
    public function username()
    {
        return $this->username;
    }
}