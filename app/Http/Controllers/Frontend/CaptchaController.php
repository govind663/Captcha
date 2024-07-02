<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CaptchaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.captcha.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend.captcha.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // getCaptcha
    // public function getCaptcha(){
    //     // get current captcha type
    //     $captchaType = session('captchaType');

    //     // generate captcha image and store it in session
    //     session(['captchaType' => $captchaType]);

    //     // return captcha image as JSON response
    //     return response()->json(['captcha'=> captcha_img($captchaType)]);
    // }
}
