<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Auth\RegisterRequest;
use App\Mail\CitizenMail;
use App\Models\Citizen;
use App\Models\Package;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class CitizenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $citizens = Citizen::with('user', 'package')->orderBy("id","desc")->where('user_type', 3 )->whereNull('deleted_at')->get();
        return view('backend.master.citizens.index', ['citizens' => $citizens]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $admins = User::orderBy("id","desc")->where('user_type', 2 )->whereNull('deleted_at')->get();
        $packages = Package::orderBy("id","desc")->whereNull('deleted_at')->get();

        return view('backend.master.citizens.create', ['admins' => $admins, 'packages' => $packages]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $citizen = new Citizen();
            $citizen->user_type = 3;
            $citizen->name = $request->get('name');
            $citizen->email = $request->get('email');
            $citizen->mobile_no = $request->get('mobile_no');
            $citizen->user_id = $request->get('user_id');
            $citizen->package_id = $request->get('package_id');
            $citizen->package_amt = $request->get('package_amt');
            $citizen->captcha_type_id = $request->get('captcha_type_id');
            $citizen->payment_type = $request->get('payment_type');
            $citizen->password = Hash::make($request->get('password'));
            $citizen->backup_password = $request->get('password');
            $citizen->created_at = Carbon::now();
            $citizen->created_by = Auth::user()->id;
            $citizen->save();


            $citizenDetails = [
                'name' =>  $citizen->name,
                'email' =>  $citizen->email,
                'password' =>  $citizen->password,
            ];

            // send Mail
            Mail::to($request->get('email'))->send(new CitizenMail($citizenDetails));

            return redirect()->route('citizen.index')->with('message','Citizen Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Citizen::find($id);
        $admins = User::orderBy("id","desc")->where('user_type', 2 )->whereNull('deleted_at')->get();
        $packages = Package::orderBy("id","desc")->whereNull('deleted_at')->get();

        return view('backend.master.citizens.show', ['citizen' => $employee, 'admins' => $admins, 'packages' => $packages]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $citizen = Citizen::find($id);
        $admins = User::orderBy("id","desc")->where('user_type', 2 )->whereNull('deleted_at')->get();
        $packages = Package::orderBy("id","desc")->whereNull('deleted_at')->get();

        return view('backend.master.citizens.edit', ['citizen' => $citizen, 'admins' => $admins, 'packages' => $packages]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RegisterRequest $request, string $id)
    {
        $request->validated();
        try {
            $citizen = Citizen::find($id);
            $citizen->user_type = 3;
            $citizen->name = $request->get('name');
            $citizen->email = $request->get('email');
            $citizen->mobile_no = $request->get('mobile_no');
            $citizen->user_id = $request->get('user_id');
            $citizen->package_id = $request->get('package_id');
            $citizen->package_amt = $request->get('package_amt');
            $citizen->captcha_type_id = $request->get('captcha_type_id');
            $citizen->payment_type = $request->get('payment_type');
            $citizen->updated_at = Carbon::now();
            $citizen->updated_by = Auth::user()->id;
            $citizen->save();

            return redirect()->route('citizen.index')->with('message','Citizen Updated Successfully');

        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong  - '.$ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $employee = Citizen::findOrFail($id);
            $employee->update($data);

            return redirect()->route('citizen.index')->with('message','Citizen Deleted Succeessfully');
        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong - '.$ex->getMessage());
        }
    }
}
