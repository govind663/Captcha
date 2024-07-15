<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CitizenPaymentRequest;
use App\Models\CitizenPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitizenPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $citizenPayment = CitizenPayment::with('citizen')->where('citizen_id', Auth::user()->id)->orderBy("id","desc")->whereNull('deleted_at')->get();
        return view('frontend.citizenPayment.index', ['citizenPayment' => $citizenPayment]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend.citizenPayment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CitizenPaymentRequest $request)
    {
        $request->validated();
        try {

            $paymentRequest = new CitizenPayment();
            $paymentRequest->citizen_id = $request->citizen_id;
            $paymentRequest->per_captcha_amt = $request->per_captcha_amt;
            $paymentRequest->request_amount = $request->request_amount;
            $paymentRequest->payment_mode = $request->payment_mode;
            $paymentRequest->transaction_date = date("Y-m-d", strtotime($request->transaction_date));
            $paymentRequest->transaction_time = date("H:i", strtotime($request->transaction_time));
            $paymentRequest->notes = $request->notes;
            $paymentRequest->inserted_at = Carbon::now();
            $paymentRequest->inserted_by = Auth::user()->id;
            $paymentRequest->save();

            // Generate Transaction Id
            $tranxationNumber = "TXN". "/" . sprintf("%06d", abs((int) $paymentRequest->id + 1))  . "/" . date("Y");
            $update = [
                'transaction_id' => $tranxationNumber,
            ];
            CitizenPayment::whereId($paymentRequest->id)->update($update);

            return redirect()->route('payment-request.index')->with('message','Payment Request Created Successfully');

        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong  - '.$ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $citizenPayment = CitizenPayment::find($id);
        return view('frontend.citizenPayment.show', ['citizenPayment' => $citizenPayment]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $citizenPayment = CitizenPayment::find($id);
        return view('frontend.citizenPayment.edit', ['citizenPayment' => $citizenPayment]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CitizenPaymentRequest $request, string $id)
    {
        $request->validated();
        try {
            $paymentRequest = CitizenPayment::find($id);
            $paymentRequest->citizen_id = $request->citizen_id;
            $paymentRequest->per_captcha_amt = $request->per_captcha_amt;
            $paymentRequest->request_amount = $request->request_amount;
            $paymentRequest->payment_mode = $request->payment_mode;
            $paymentRequest->transaction_date = date("Y-m-d", strtotime($request->transaction_date));
            $paymentRequest->transaction_time = date("H:i", strtotime($request->transaction_time));
            $paymentRequest->notes = $request->notes;
            $paymentRequest->updated_at = Carbon::now();
            $paymentRequest->updated_by = Auth::user()->id;
            $paymentRequest->save();

            return redirect()->route('payment-request.index')->with('message','Payment Request Updated Successfully');

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
            $paymentRequest = CitizenPayment::find($id);
            $paymentRequest->update($data);

            return redirect()->route('payment-request.index')->with('message','Payment Request Deleted Succeessfully');
        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong - '.$ex->getMessage());
        }
    }
}
