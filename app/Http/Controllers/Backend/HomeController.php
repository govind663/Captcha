<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repository\Backend\AdminRepository;
use App\Repository\Backend\CitizenRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{

    protected $adminRepository, $citizenRepository;

    public function __construct(AdminRepository $adminRepository, CitizenRepository $citizenRepository){

        $this->adminRepository = $adminRepository;
        $this->citizenRepository = $citizenRepository;
    }

    public function Admin_Home(){
        // ==== get Admin Auth ID or userType
        $adminId = auth()->user()->id;
        $adminUserType = auth()->user()->user_type;

        // ==== Total Admin
        $totalAdmin = $this->adminRepository->getAdminCount();

        // ==== Total Citizen
        $totalCitizen = $this->citizenRepository->getCitizenCount($adminId, $adminUserType);

        return view('backend.admin-dashboard', ['totalAdmin' => $totalAdmin, 'totalCitizen' => $totalCitizen]);
    }

    public function changePassword(Request $request)
    {
        return view('backend.auth.change_password');
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
            User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->password)
            ]);

            return back()->with("message", "Password changed successfully!");
    }
}
