<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CaptchaTypeRequest;
use App\Models\CaptchaType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class CaptchaTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $captchaTypes = CaptchaType::orderBy("id","desc")->whereNull('deleted_at')->get();

        return view('backend.master.captcha-types.index', ['captchaTypes' => $captchaTypes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.master.captcha-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CaptchaTypeRequest $request)
    {
        $request->validated();
        try {
            $data = new CaptchaType();
            $data->type_name = $request->get('type_name');
            $data->inserted_at = Carbon::now();
            $data->inserted_by = Auth::user()->id;
            $data->save();

            return redirect()->route('captcha-type.index')->with('message','Captcha Type Created Successfully');

        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong  - '.$ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $captchaType = CaptchaType::findOrFail($id);
        return view('backend.master.captcha-types.show', ['captchaType' => $captchaType]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $captchaType = CaptchaType::findOrFail($id);
        return view('backend.master.captcha-types.edit', ['captchaType' => $captchaType]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CaptchaTypeRequest $request, string $id)
    {
        $request->validated();
        try {
            $data = CaptchaType::findOrFail($id);;
            $data->type_name = $request->get('type_name');
            $data->modified_at = Carbon::now();
            $data->modified_by = Auth::user()->id;
            $data->save();

            return redirect()->route('captcha-type.index')->with('message','Captcha Type Updated Successfully');

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
            $captchaType = CaptchaType::findOrFail($id);
            $captchaType->update($data);

            return redirect()->route('captcha-type.index')->with('message','Captcha Type Deleted Succeessfully');
        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong - '.$ex->getMessage());
        }
    }
}
