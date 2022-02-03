<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ThrottlesLogins;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;

class LoginController extends Controller
{

    protected $redirectTo = RouteServiceProvider::HOME;
    /**
     * Show the login form.
     * 
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm()
    {
        return view('admin-auth.login', [
            'title' => 'Login',
            'loginRoute' => 'login',
            'forgotPasswordRoute' => 'password.request',
        ]);
    }

    /**
     * Login the admin.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    // public function login(Request $request)
    // {
    //     $email = $request->email;
    //     $admin = DB::table('admins')
    //         ->where('email', $email)
    //         ->select()->get();
    //     if ($admin[0]->u_type == 1) {
    //         $this->validator($request);

    //         if (Auth::guard('admin')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
    //             //Authentication passed...
    //             return redirect()
    //                 ->intended(route('admin.home'))
    //                 ->with('status', 'You are Logged in as Admin!');
    //         }
    //     } else {
    //         //Authentication failed...
    //         return $this->loginFailed();
    //     }
    // }

    public function login(Request $request)
    {
        //validate the fields....
        $email = $request->email;
        $admin = DB::table('admins')
            ->where('email', $email)
            ->select()->get();
        if ($admin[0]->u_type == 1) {
            $credentials = ['email' => $request->email, 'password' => $request->password];

            if (Auth::guard('admin')->attempt($credentials, $request->remember)) { // login attempt
                //login successful, redirect the user to your preferred url/route...

                return redirect()
                    ->intended(route('admin.dashboard'))
                    ->with('success', 'You are logged in as an admin.');
            } else {
                //Authentication failed...
                return $this->loginFailed()
                    ->with('failed', 'Admin login failed! Please try again.');
            }
        } else {
            //Authentication failed...
            return $this->loginFailed()
                ->with('failed', 'Admin login failed! Please try again.');
        }

        //login failed...
    }
    /**
     * Logout the admin.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()
            ->route('login')
            ->with('status', 'Admin has been logged out!');
    }

    /**
     * Validate the form data.
     * 
     * @param \Illuminate\Http\Request $request
     * @return 
     */
    private function validator(Request $request)
    {
        //validation rules.
        $rules = [
            'email'    => 'required|email|exists:admins|min:5|max:191',
            'password' => 'required|string|min:4|max:255',
        ];

        //custom validation error messages.
        $messages = [
            'email.exists' => 'These credentials do not match our records.',
        ];

        //validate the request.
        $request->validate($rules, $messages);
    }

    /**
     * Redirect back after a failed login.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    private function loginFailed()
    {
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Login failed, please try again!');
    }
}
