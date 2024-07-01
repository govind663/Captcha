<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Auth\RegisterRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = User::orderBy("id","desc")->where('user_type', 2 )->whereNull('deleted_at')->get();
        return view('backend.master.admin.index', ['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.master.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterRequest $request)
    {
        $request->validated();
        try {
            $data = new User();
            $data->user_type = $request->get('user_type');
            $data->name = $request->get('name');
            $data->email = $request->get('email');
            $data->password = Hash::make($request->get('password'));
            $data->created_at = Carbon::now();
            $data->created_by = Auth::user()->id;
            $data->save();

            return redirect()->route('admin.index')->with('message','Employee Created Successfully');

        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong  - '.$ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = User::find($id);
        return view('backend.master.admin.show', ['employee' => $employee]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = User::find($id);
        return view('backend.master.admin.edit', ['employee' => $employee]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RegisterRequest $request, string $id)
    {
        $request->validated();
        try {
            $data = User::find($id);
            $data->user_type = $request->get('user_type');
            $data->name = $request->get('name');
            $data->email = $request->get('email');
            $data->updated_at = Carbon::now();
            $data->updated_by = Auth::user()->id;
            $data->save();

            return redirect()->route('admin.index')->with('message','Employee Updated Successfully');

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
            $employee = User::findOrFail($id);
            $employee->update($data);

            return redirect()->route('admin.index')->with('message','Employee Deleted Succeessfully');
        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong - '.$ex->getMessage());
        }
    }
}
