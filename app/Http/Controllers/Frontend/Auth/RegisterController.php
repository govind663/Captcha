<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Auth\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\Citizen;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function Citizen_Register_Form()
    {
        return view('frontend.auth.register');
    }

    public function Citizen_Store_Register(Request $request){
        $request->validated();
        try {
            $data = new Citizen();
            $data->name = $request->get('name');
            $data->user_type = $request->get('user_type');
            $data->email = $request->get('email');
            $data->password = Hash::make($request->get('password'));
            $data->created_at = date("Y-m-d H:i:s");
            $data->save();

            $update = [
                'created_by' => $data->id,
            ];

            Citizen::where('id', $data->id)->update($update);

            return redirect()->route('citizen.login')->with('message', 'You are Register Sucessfully.');

        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong  - '.$ex->getMessage());
        }
    }
}
