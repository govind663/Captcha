<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Captcha;
use App\Models\CaptchaCount;
use App\Models\Citizen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function Citizen_Home(){
        // ==== total Earning
        $totalEarning = CaptchaCount::where('citizen_id', Auth::user()->id)->whereNull('deleted_at')->pluck('per_captcha_amount')->first();

        // ==== total right captcha count
        $rightCaptchaCount = CaptchaCount::where('citizen_id', Auth::user()->id)->whereNull('deleted_at')->pluck('is_correct_captcha_count')->first();

        // ==== total wrong captcha count
        $wrongCaptchaCount = CaptchaCount::where('citizen_id', Auth::user()->id)->whereNull('deleted_at')->pluck('is_wrong_captcha_count')->first();

        // ==== total captcha count
        $totalCaptchaCount = Captcha::where('citizen_id', Auth::user()->id)->whereNull('deleted_at')->count('id');

        return view('frontend.citizen-dashboard',
        [
            'totalEarning'=> $totalEarning,
            'wrongCaptchaCount'=> $wrongCaptchaCount,
            'rightCaptchaCount'=> $rightCaptchaCount,
            'totalCaptchaCount'=> $totalCaptchaCount
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

    // ===== editProfile
    public function editProfile(string $id){
        $citizen = Citizen::with('user', 'package','captchaType')->find($id);
        return view('frontend.auth.profile',['citizen'=>$citizen]);
    }

    // ==== updateProfile
    protected function updateProfile(Request $request, string $id){
        $request->validate([
            'bank_name' =>'required|string|max:255',
            'branch_name' =>'required|string|max:255',
            'account_holder_name' =>'required|string|max:255',
            'account_number' =>'required|string|max:255',
            'ifsc_code' =>'required|string|max:255',
        ],[
            'bank_name.required' => 'Bank Name is required',
            'branch_name.required' => 'Branch Name is required',
            'account_holder_name.required' => 'Account Holder Name is required',
            'account_number.required' => 'Account Number is required',
            'ifsc_code.required' => 'IFSC Code is required',
        ]);

        try {

            $citizenProfile = Citizen::find($id);
            $citizenProfile->bank_name = $request->bank_name;
            $citizenProfile->branch_name = $request->branch_name;
            $citizenProfile->account_holder_name = $request->account_holder_name;
            $citizenProfile->account_number = $request->account_number;
            $citizenProfile->ifsc_code = $request->ifsc_code;
            $citizenProfile->updated_at = date('Y-m-d H:i:s');
            $citizenProfile->updated_by = Auth::user()->id;
            $citizenProfile->save();

            return redirect()->route('citizen.dashboard')->with('success', 'Profile updated successfully.');

        } catch (\Exception $ex) {
            return redirect()->back()->with('error','Something Went Wrong  - '.$ex->getMessage());
        }
    }
}
