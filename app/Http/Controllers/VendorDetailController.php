<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VendorDetail;
use App\Models\Project;
use App\Models\Country;
use Illuminate\Support\Str;

class VendorDetailController extends Controller
{
    public function index()
    {
        $vendordetails = VendorDetail::all();
        foreach($vendordetails as $vendordetail){
            $vendorOb[] = VendorDetail::getVendorDetails($vendordetail->pki_vendordetail_id);
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
            'vendor' => 'required',
            'fki_project_id' => 'required|integer',
            'cpi' => 'required',
            'required_completes' => 'required'
        ]);
        
        \DB::beginTransaction();
        $vendorOb = new VendorDetail();
        $vendorOb->vendor = $request->vendor;
        $vendorOb->fki_project_id = $request->fki_project_id;
        $vendorOb->cpi = $request->cpi;
        $vendorOb->required_completes = $request->required_completes;
        $vendorOb->created = \Carbon\Carbon::now();
        $vendorOb->updated = \Carbon\Carbon::now();
        $vendorOb->survey_url = "";
        $vendorOb->save();
        $urlToken = Str::uuid();
        $vendorOb->survey_url = $request->getHost()."/survey/".$urlToken.$vendorOb->pki_vendordetail_id."?pid=";
        $vendorOb->save();
        \DB::commit();

        return redirect()
                ->route('vendordetails.edit', $vendorOb->pki_vendordetail_id);
    }

    public function edit($vendor_id)
    {   
        $vendor = VendorDetail::find($vendor_id);
        $project = Project::find($vendor->fki_project_id);
        $countries = Country::all();
        return view('vendordetails.edit', [
            'vendor'=>$vendor,
            'project'=>$project,
            'countries'=>$countries
        ]);
    }

    public function update(Request $request)
    {
        if($request->_token){
            $vendor = VendorDetail::find($request->vendordetail_id);
            if($request->cpi){
                $vendor->cpi = $request->cpi;
            }
            if($request->required_completes){
                $vendor->required_completes = $request->required_completes;
            }
            if($request->survey_url){
                $vendor->survey_url = trim($request->survey_url);
            }
            if($request->complete_url){
                $vendor->complete_url = trim($request->complete_url);
            }
            if($request->disqualify_url){
                $vendor->disqualify_url = trim($request->disqualify_url);
            }
            if($request->quotafull_url){
                $vendor->quotafull_url = trim($request->quotafull_url);
            }
            if($request->quality_term_url){
                $vendor->quality_term_url = trim($request->quality_term_url);
            }
            if($request->status){
                $vendor->active = $request->status;
            }
            $vendor->updated = \Carbon\Carbon::now();
            $vendor->save();

            return redirect()
                ->route('vendordetails.edit', $vendor->pki_vendordetail_id);
            
        }
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('client.index')
            ->with('success', 'Client deleted successfully');
    }
}
