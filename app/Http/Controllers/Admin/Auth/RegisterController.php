<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\Admin;


class RegisterController extends Controller
{
    protected $redirectTo = RouteServiceProvider::HOME;
    /**
     * Show the Register form.
     * 
     * @return \Illuminate\Http\Response
     */
    public function showRegisterForm()
    {
        return view('admin-auth.register', [
            'title' => 'Login',
            'loginRoute' => 'login',
            'forgotPasswordRoute' => 'password.request',
        ]);
    }

    public function register(Request $request)
    {
        $validation = [
            'name'     => 'required| max:50',
            'email'    => 'required|email|unique:admins',
            'password' => 'required|min:6',
        ];
        $validator = Validator::make($request->all(), $validation);
        if ($validator->fails()) {
            echo "Validation failed";
            return redirect()
                ->intended(route('register'))
                ->with('failed', 'Admin validation failed');
        } else {
            $admin = new Admin();
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->password = Hash::make($request->password);
            if ($admin->save()) {
                return redirect()
                    ->intended(route('login'))
                    ->with('success', 'Thank you for your admin registraion. Please wait for admin approval.');
            } else {
                return redirect()
                    ->intended(route('register'))
                    ->with('failed', 'Admin registratioin failed! Please try again.');
            }
        }
    }
}
