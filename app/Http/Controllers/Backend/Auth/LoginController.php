<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->route('dashboard');
        } else {
            return view('backend.auth.login');
        }
    }

    public function authenticate(LoginRequest $request)
    {
        $data = $request->validated();

        $credentials['email'] = $request->input('email');
        $credentials['password'] = $request->input('password');
        $remember_me = $request->has('remember_token')? true : false;

        if (Auth::guard('web')->attempt($credentials, $remember_me)) {
            // Session::put('email', $request->input('email'));

            return redirect()->route('dashboard')->with('message', 'You are login Successfully.');
        }
        else{
            return redirect()->route('/')->with(['Input' => $request->only('email','password'), 'error' => 'Your Email id and Password do not match our records!']);
        }

    }

    public function logout() {
        Session::flush();
        Auth::logout();

        return redirect()->route('/')->with('message', 'You are logout Successfully.');
    }
}
