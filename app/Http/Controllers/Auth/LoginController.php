<?php

namespace chilliapp\Http\Controllers\Auth;

use chilliapp\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function signin(Request $request)
    {
        $this->validate($request, [
            'phone'     => 'required|min:4|max:255',
            'password'  => 'required|min:8|max:255'
            ]);

        if (Auth::attempt($request->only(['phone','password']),
            $request->has('remember')))
        {   
            $user_id = Auth::user()->id;
            
            return redirect('/home');
        } else {
            return redirect('/signin')->with('error','Incorrent credentials, please try again.');
        }
    }

    public function signout(Request $request)
    {  
        Auth::logout();

        return redirect('/signin');
    } 
}
