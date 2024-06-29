<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Auth\RegisterRequest;
use App\Models\Citizen;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CitizenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $citizens = Citizen::orderBy("id","desc")->where('user_type', 3 )->whereNull('deleted_at')->get();
        return view('backend.master.citizens.index', ['citizens' => $citizens]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.master.citizens.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterRequest $request)
    {
        $request->validated();
        try {
            $data = new Citizen();
            $data->user_type = $request->get('user_type');
            $data->name = $request->get('name');
            $data->email = $request->get('email');
            $data->password = Hash::make($request->get('password'));
            $data->created_at = date("Y-m-d H:i:s");
            $data->created_by = Auth::user()->id;
            $data->save();

            return redirect()->route('citizen.index')->with('message','Citizen Created Successfully');

        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong  - '.$ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Citizen::find($id);
        return view('backend.master.citizens.show', ['citizen' => $employee]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $citizen = Citizen::find($id);
        return view('backend.master.citizens.edit', ['citizen' => $citizen]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RegisterRequest $request, string $id)
    {
        $request->validated();
        try {
            $data = Citizen::find($id);
            $data->user_type = $request->get('user_type');
            $data->name = $request->get('name');
            $data->email = $request->get('email');
            $data->updated_at = date("Y-m-d H:i:s");
            $data->updated_by = Auth::user()->id;
            $data->save();

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
