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
        $citizenPayment = CitizenPayment::where('citizen_id', Auth::user()->id)->orderBy("id","desc")->whereNull('deleted_at')->get();
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, string $id)
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
            $citizenPayment = CitizenPayment::find($id);
            $citizenPayment->update($data);

            return redirect()->route('payment-request.index')->with('message','Payment Deleted Succeessfully');
        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong - '.$ex->getMessage());
        }
    }
}
