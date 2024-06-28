<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register()
    {
        return view('backend.auth.register');
    }

    public function store(RegisterRequest $request)
    {
        $request->validated();
        try {
            $data = new User();
            $data->name = $request->get('name');
            $data->user_type = $request->get('user_type');
            $data->email = $request->get('email');
            $data->password = Hash::make($request->get('password'));
            $data->created_at = date("Y-m-d H:i:s");
            $data->save();

            $update = [
                'created_by' => $data->id,
            ];

            User::where('id', $data->id)->update($update);

            return redirect()->route('login')->with('message', 'You are Register Sucessfully.');

        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong  - '.$ex->getMessage());
        }
    }
}
