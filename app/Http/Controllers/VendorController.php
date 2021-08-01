<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\Country;
use App\Models\Currency;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $vendors = Vendor::all();
        return view('vendors.index', [
            'vendors'=>$vendors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'vendor' => 'required',
            'email' => 'required',
            'complete_url' => 'required',
            'disqualify_url' => 'required',
            'quotafull_url' => 'required',
            'quality_term_url' => 'required',
        ]);
        
        \DB::beginTransaction();
        $vendorOb = new Vendor();
        $vendorOb->vendor = $request->vendor;
        $vendorOb->email = $request->email;
        $vendorOb->complete_url = $request->complete_url;
        $vendorOb->disqualify_url = $request->disqualify_url;
        $vendorOb->quotafull_url = $request->quotafull_url;
        $vendorOb->quality_term_url = $request->quality_term_url;
        if($request->phone){
            $vendorOb->phone = $request->phone;
        }
        if($request->address){
            $vendorOb->billing_address = $request->address;
        }
        $vendorOb->created = \Carbon\Carbon::now();
        $vendorOb->updated = \Carbon\Carbon::now();

        $vendorOb->save();
        \DB::commit();
            
        return redirect()->route('vendors.edit', $vendorOb->pki_vendor_id)
            ->with('success', 'Vendor added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($vendor_id)
    {   
        $vendor = Vendor::find($vendor_id);
        $countries = Country::all();
        $currencies = Currency::all();
        return view('vendors.edit', [
            'vendor' => $vendor,
            'currencies' => $currencies,
            'countries' => $countries,
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   
        if($request->_token){
            $vendor = Vendor::find($request->pki_vendor_id);
            if($request->email){
                $vendor->email = $request->email;
            }
            if($request->phone){
                $vendor->phone = $request->phone;
            }
            if($request->address){
                $vendor->billing_address = $request->address;
            }
            if($request->complete_url){
                $vendor->complete_url = $request->complete_url;
            }
            if($request->disqualify_url){
                $vendor->disqualify_url = $request->disqualify_url;
            }
            if($request->quotafull_url){
                $vendor->quotafull_url = $request->quotafull_url;
            }
            if($request->quality_term_url){
                $vendor->quality_term_url = $request->quality_term_url;
            }
            $vendor->save();
            
            return redirect()->route('vendors.edit', $vendor->pki_vendor_id)
            ->with('success', 'Vendor updated successfully');
            
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function remove(Request $request)
    {
        Vendor::updateClient($request->vendor_id, [
            'active' => 0
        ]);
        return redirect()->route('vendors.index')
            ->with('success', 'Vendor removed successfully');
    }
}