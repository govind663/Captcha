<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function Citizen_Login_Form()
    {
        if (Auth::guard('citizen')->check()) {
            return redirect()->route('citizen.dashboard');
        } else {
            return view('frontend.auth.login');
        }

    }

    public function Citizen_Authenticate(LoginRequest $request)
    {
        $credentials = $request->validated();
        $credentials['email'] = $request->input('email');
        $credentials['password'] = $request->input('password');
        $remember_me = $request->has('remember_token')? true : false;

        if (auth()->guard('citizen')->attempt($credentials, $remember_me)) {

            return redirect()->route('citizen.dashboard')->with('message', 'You are login Successfully.');
        }
        else{
            return redirect()->route('citizen.login')->with(['Input' => $request->only('email','password'), 'error' => 'Your Email Id and Password do not match our records!']);
        }

    }

    public function Citizen_Logout(Request $request) {

        Auth::guard('citizen')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('citizen.login')->with('message', 'You are logout Successfully.');
    }
}
