<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //show the login page
    public function index(){
        return view('auth.login');
    }

    //attempt to login
    public function login(Request $request){

        //validate the input fields
        $request->validate([
            'email' => 'required',
         'password' => 'required'
        ]);

        //check wheather the user credentials is valid
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            
            $request->session()->regenerate();
            $user_id = Auth::user()->id;
            return redirect()->intended('/user/exam/'.$user_id);
        }
        
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);


    }
}
