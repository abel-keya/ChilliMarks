<?php

namespace chillimarks\Http\Controllers\Auth;

use Illuminate\Http\Request;
use chillimarks\Http\Controllers\Controller;
use chillimarks\Models\User;
use Auth;

class LoginController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('signout');
    }

    public function index()
    {   
        $page = 'ChilliMarks';

        return view('core.auth.signin', compact('page'));
    }

    public function signin(Request $request)
    {
        $this->validate($request, [
            'phone'     => 'required|min:4|max:255',
            'password'  => 'required|min:8|max:255'
            ]);


        if(Auth::attempt($request->only(['phone','password'])))
        {   
            if(Auth::user()->hasRole('teacher'))
            {
                return redirect('teacher-assessments');
            }

            return redirect('exams');
        } else {
            return redirect()->back()->with('error','Incorrent credentials, please try again.');
        }
    }

    public function signout(Request $request)
    {  
        Auth::logout();

        return redirect('/');
    } 
}
