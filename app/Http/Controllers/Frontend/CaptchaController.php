<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CaptchaRequest;
use App\Models\Captcha;
use App\Models\CaptchaCount;
use App\Models\CaptchaType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CaptchaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $captcha = Captcha::with('citizen', 'captchaType')->where('citizen_id', Auth::user()->id)->orderBy("id","desc")->whereNull('deleted_at')->get();
        $captchaCount = CaptchaCount::where('citizen_id', Auth::user()->id)->first();

        return view('frontend.captcha.index', ['captcha' => $captcha]);
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
    public function store(CaptchaRequest $request)
    {
        $validator = $request->validated();

        try {
            $captcha = new Captcha();
            $captcha->citizen_id = Auth::user()->id;
            $captcha->captcha_type_id = $request->captcha_type_id;
            $captcha->captcha_length = $request->captcha_length;
            $captcha->captcha_code = $request->captcha_code;
            $captcha->is_active = 1;
            $captcha->inserted_at = Carbon::now();
            $captcha->inserted_by = Auth::user()->id;
            $captcha->save();

            // update captcha count
            $captchaCount = CaptchaCount::where('citizen_id', Auth::user()->id)->first();
            if($captchaCount){
                $currentCaptchaCount = 0;
                $captchaCount->captcha_id = $captcha->id;
                $captchaCount->is_correct_captcha_count = $captchaCount->is_correct_captcha_count + 1;

                // update per_captcha_amount based on package_amt if available
                $captchaCount->per_captcha_amount = $request->package_amt ? $captchaCount->per_captcha_amount + $request->package_amt : $captchaCount->per_captcha_amount;


                $captchaCount->modified_at = Carbon::now();
                $captchaCount->modified_by = Auth::user()->id;
                $captchaCount->save();
            }else{
                CaptchaCount::create([
                    'citizen_id' => Auth::user()->id,
                    'captcha_id' => $captcha->id,
                    'is_wrong_captcha_count' => 0,
                    'is_correct_captcha_count' => 1,
                    'per_captcha_amount' => $captcha->package_amt ? $captcha->package_amt : 0,
                    'inserted_at' => Carbon::now(),
                    'inserted_by' => Auth::user()->id,
                ]);
            }

            return redirect()->route('citizen.dashboard')->with('message','Captcha has been successfully added to your system.');

        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong  - '.$ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $captcha = Captcha::with('citizen', 'captchaType')->find($id);
        return view('frontend.captcha.show', ['captcha' => $captcha]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $captcha = Captcha::with('citizen', 'captchaType')->find($id);
        return view('frontend.captcha.edit', ['captcha' => $captcha]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CaptchaRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $captcha = Captcha::find($id);
            $captcha->update($data);

            return redirect()->route('package.index')->with('message','Package Deleted Succeessfully');
        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong - '.$ex->getMessage());
        }
    }

    // ==== getCaptcha
    public function getCaptcha($type = 'default', Request $request){
        // get captcha_type_id
        $captchaTypeId = $request->captcha_type_id;

        // check CaptchaTypeId
        $captchaType = CaptchaType::find($captchaTypeId);
        if(!$captchaType){
            return response()->json(['error' => 'Invalid Captcha Type'], 400);
        }
        // return captcha image as response  with content type as image/png  and header with content type as image/png  and header with content type as image/png   and header with content type as image/png  and header with content type as image/
        return response(captcha_src($captchaType))->header('Content-Type', 'image/png');
    }

}
