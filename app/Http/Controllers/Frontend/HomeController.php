<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CaptchaCount;
use App\Models\Citizen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function Citizen_Home(){

        // ==== total captcha amount
        $totalCaptchaAmount = CaptchaCount::where('citizen_id', Auth::user()->id)->whereNull('deleted_at')->pluck('per_captcha_amount')->first();
        // ==== wrongCaptchaCount
        $rightCaptchaCount = CaptchaCount::where('citizen_id', Auth::user()->id)->whereNull('deleted_at')->pluck('is_correct_captcha_count')->first();

        // ==== wrongCaptchaCount
        $wrongCaptchaCount = CaptchaCount::where('citizen_id', Auth::user()->id)->whereNull('deleted_at')->pluck('is_wrong_captcha_count')->first();

        return view('frontend.citizen-dashboard',
        [
            'totalCaptchaAmount'=> $totalCaptchaAmount,
            'wrongCaptchaCount'=> $wrongCaptchaCount,
            'rightCaptchaCount'=> $rightCaptchaCount
        ]);
    }

    public function changePassword(Request $request)
    {
        return view('frontend.auth.change_password');
    }

    public function updatePassword(Request $request)
    {
            # Validation
            $request->validate([
                'current_password' => 'required',
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required',
            ],[
                'current_password.required' => 'Current Password is required',
                'password.required' => 'New Password is required',
                'password_confirmation.required' => 'Confirm Password is required',
            ]);


            #Match The Old Password
            if(!Hash::check($request->current_password, auth()->user()->password)){
                return back()->with("error", "Old Password Doesn't match!");
            }


            #Update the new Password
            Citizen::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->password)
            ]);

            return back()->with("message", "Password changed successfully!");
    }

    // ===== viewProfile
    public function viewProfile(string $id){
        $citizen = Citizen::with('user', 'package')->find($id);
        return view('frontend.auth.profile',['citizen'=>$citizen]);
    }
}
