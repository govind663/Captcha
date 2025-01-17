<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\PackageRequest;
use App\Models\CaptchaType;
use App\Models\Package;
use App\Models\PackageType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packages = Package::with('packageType','captchaType')->orderBy("id","desc")->whereNull('deleted_at')->get();

        return view('backend.master.packages.index', ['packages' => $packages,]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $packageTypes = PackageType::orderBy("id","desc")->whereNull('deleted_at')->get();
        $captchaTypes = CaptchaType::orderBy("id","desc")->whereNull('deleted_at')->get();

        return view('backend.master.packages.create', ['packageTypes' => $packageTypes, 'captchaTypes' => $captchaTypes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PackageRequest $request)
    {
        $data = $request->validated();
        try {

            $package = new Package();

            // ==== Upload (image)
            if (!empty($request->hasFile('image'))) {
                $image = $request->file('image');
                $image_name = $image->getClientOriginalName();
                $extension = $image->getClientOriginalExtension();
                $new_name = time() . rand(10, 999) . '.' . $extension;
                $image->move(public_path('/captcha/package/image'), $new_name);

                $image_path = "/captcha/package/image" . $image_name;
                $package->image = $new_name;
            }

            $package->name = $data['name'];
            $package->package_type_id = $data['package_type_id'];
            $package->captcha_type_id = $data['captcha_type_id'];
            $package->description = $data['description'];
            $package->amount = $data['amount'];
            $package->inserted_at = Carbon::now();
            $package->inserted_by = Auth::user()->id;
            $package->save();

            return redirect()->route('package.index')->with('message','Package Created Successfully');

        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong  - '.$ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $package = Package::find($id);
        return view('backend.master.packages.show', ['package' => $package]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $package = Package::find($id);
        $packageTypes = PackageType::orderBy("id","desc")->whereNull('deleted_at')->get();
        $captchaTypes = CaptchaType::orderBy("id","desc")->whereNull('deleted_at')->get();

        return view('backend.master.packages.edit', ['package' => $package, 'packageTypes' => $packageTypes, 'captchaTypes' => $captchaTypes]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PackageRequest $request, string $id)
    {
        $data = $request->validated();
        try {

            $package = Package::find($id);

            // ==== Upload (image)
            if (!empty($request->hasFile('image'))) {
                $image = $request->file('image');
                $image_name = $image->getClientOriginalName();
                $extension = $image->getClientOriginalExtension();
                $new_name = time() . rand(10, 999) . '.' . $extension;
                $image->move(public_path('/captcha/package/image'), $new_name);

                $image_path = "/captcha/package/image" . $image_name;
                $package->image = $new_name;
            }

            $package->name = $data['name'];
            $package->package_type_id = $data['package_type_id'];
            $package->captcha_type_id = $data['captcha_type_id'];
            $package->description = $data['description'];
            $package->amount = $data['amount'];
            $package->modified_at = Carbon::now();
            $package->modified_by = Auth::user()->id;
            $package->save();

            return redirect()->route('package.index')->with('message','Package Updated Successfully');

        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong - '.$ex->getMessage());
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
            $package = Package::find($id);
            $package->update($data);

            return redirect()->route('package.index')->with('message','Package Deleted Succeessfully');
        } catch(\Exception $ex){

            return redirect()->back()->with('error','Something Went Wrong - '.$ex->getMessage());
        }
    }

    //  ==== package_amt
    public function package_amt(Request $request){
        $package_id = $request->packageId;
        $data['package_amount'] = Package::whereId($package_id)->whereNull('deleted_at')->pluck('amount');
        $data['captcha_type'] = Package::whereId($package_id)->whereNull('deleted_at')->pluck('captcha_type_id');
        return response()->json($data);
    }
}
