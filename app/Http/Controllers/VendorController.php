<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\Country;
use App\Models\Currency;

class VendorController extends Controller
{
    public function index()
    {
        $vendors = Vendor::all();
        return view('vendors.index', [
            'vendors'=>$vendors
        ]);
    }

    public function create()
    {   $countries = Country::all();
        $currencies = Currency::all();
        return view('vendors.add', [
            'countries' => $countries,
            'currencies' => $currencies
        ]);
    }

    public function store(Request $request)
    {   
        $request->validate([
            'vendor' => 'required',
            'complete_url' => 'required',
            'disqualify_url' => 'required',
            'quotafull_url' => 'required',
            'qualityterm_url' => 'required'
        ]);
        
        \DB::beginTransaction();
        $vendorOb = new Vendor();
        $vendorOb->fki_country_id = $request->fki_country_id;
        if($request->fki_currency_id){
            $vendorOb->fki_currency_id = $request->fki_currency_id;
        }
        $vendorOb->vendor = $request->vendor;
        if($request->reference_name){
            $vendorOb->reference_name = $request->reference_name;
        }
        $vendorOb->complete_url = $request->complete_url;
        $vendorOb->disqualify_url = $request->disqualify_url;
        $vendorOb->quotafull_url = $request->quotafull_url;
        $vendorOb->quality_term_url = $request->qualityterm_url;
        $vendorOb->created = \Carbon\Carbon::now();
        $vendorOb->updated = \Carbon\Carbon::now();
        $vendorOb->save();
        \DB::commit();

        return redirect()->route('vendors.index')
            ->with('success', 'Vendor updated successfully');
    }

    public function show($project_id)
    {   
        //
    }

    public function update(Request $request, Client $client)
    {
        //
    }

    public function destroy(Client $client)
    {
        //
    }
}
