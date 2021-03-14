<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VendorDetail;

class VendorDetailController extends Controller
{
    public function index()
    {
        $vendordetails = VendorDetail::all();
        foreach($vendordetails as $index => $vendordetail){
            $vendorOb[$index] = VendorDetail::getVendorDetails($vendordetail->pki_vendordetail_id);
        }
        return view('vendordetails.index', [
            'vendordetails'=>$vendorOb
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {   
        $request->validate([
            'fki_vendor_id' => 'required|integer',
            'fki_project_id' => 'required|integer',
            'cpi' => 'required',
            'required_completes' => 'required',
            'survey_link' => 'required'
        ]);
        
        \DB::beginTransaction();
        $vendorOb = new VendorDetail();
        $vendorOb->fki_vendor_id = $request->fki_vendor_id;
        $vendorOb->fki_project_id = $request->fki_project_id;
        $vendorOb->cpi = $request->cpi;
        $vendorOb->required_completes = $request->required_completes;
        $vendorOb->survey_url = $request->survey_link;
        if($request->complete_url){
            $vendorOb->complete_url = $request->complete_url;
        }
        if($request->disqualify_url){
            $vendorOb->disqualify_url = $request->disqualify_url;
        }
        if($request->quotafull_url){
            $vendorOb->quotafull_url = $request->quotafull_url;
        }
        if($request->qualityterm_url){
            $vendorOb->quality_term_url = $request->qualityterm_url;
        }
        $vendorOb->created = \Carbon\Carbon::now();
        $vendorOb->updated = \Carbon\Carbon::now();
        $vendorOb->save();
        \DB::commit();

        return redirect()->route('vendordetails.index')
            ->with('success', 'Vendor added successfully');
    }

    public function show($project_id)
    {   
        //
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $client->update($request->all());

        return redirect()->route('client.index')
            ->with('success', 'Client updated successfully');
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('client.index')
            ->with('success', 'Client deleted successfully');
    }
}
