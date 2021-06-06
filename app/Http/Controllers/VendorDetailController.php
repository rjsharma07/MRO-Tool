<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\VendorDetail;
use App\Models\Project;
use App\Models\Country;
use App\Models\ProjectStatus;
use Illuminate\Support\Str;

class VendorDetailController extends Controller
{
    public function index()
    {
        $vendordetails = VendorDetail::getVendorDetails();
        $projectStatuses = ProjectStatus::all();
        return view('vendordetails.index', [
            'vendordetails'=>$vendordetails,
            'projectstatuses'=>$projectStatuses
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'fki_project_id' => 'required|integer',
            'fki_vendor_id' => 'required',
            'cpi' => 'required',
            'required_completes' => 'required'
        ]);
        $vendor = Vendor::where('pki_vendor_id', $request->fki_vendor_id)->first();
        \DB::beginTransaction();
        $vendorOb = new VendorDetail();
        $vendorOb->fki_vendor_id = $request->fki_vendor_id;
        $vendorOb->fki_project_id = $request->fki_project_id;
        $vendorOb->cpi = $request->cpi;
        $vendorOb->required_completes = $request->required_completes;
        $vendorOb->complete_url = $vendor->complete_url;
        $vendorOb->disqualify_url = $vendor->disqualify_url;
        $vendorOb->quotafull_url = $vendor->quotafull_url;
        $vendorOb->quality_term_url = $vendor->quality_term_url;
        $vendorOb->survey_check = $request->survey_check;
        $vendorOb->created = \Carbon\Carbon::now();
        $vendorOb->updated = \Carbon\Carbon::now();
        $vendorOb->survey_url = "";
        $urlToken = Str::uuid();
        $vendorOb->survey_url = $request->getHost()."/survey/".$urlToken.$vendorOb->pki_vendordetail_id."?pid=";
        $vendorOb->save();
        \DB::commit();

        return redirect()
                ->route('vendordetails.edit', $vendorOb->pki_vendordetail_id);
    }

    public function edit($vendordetail_id)
    {   
        $vendor = VendorDetail::getVendorDetails($vendordetail_id);
        $countries = Country::all();
        return view('vendordetails.edit', [
            'vendor'=>$vendor,
            'countries'=>$countries
        ]);
    }

    public function show($vendor_id)
    {   
        $vendorDetail = VendorDetail::find($vendor_id);
        $project = Project::find($vendorDetail->fki_project_id);
        $countries = Country::all();
        return view('vendordetails.show', [
            'vendor'=>$vendorDetail,
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
                ->to('/projects/edit/'.$vendor->fki_project_id.'#vendordetails')
                ->with('success', 'Vendor details updated successfully!');
        }
    }

    public function remove(Request $request)
    {
        VendorDetail::updateVendorDetails($request->vendordetail_id, [
            'active' => 0
        ]);
        return redirect()->back()->with('success', 'Vendor details removed successfully!');
    }

    public function getVendorDetailsById($vendor_id)
    {
        try {
            $details = VendorDetail::getVendorDetailsById($vendor_id);
            return response([
                'success' => true,
                'message' => 'OK',
                'data' => $details
            ])->header("Access-Control-Allow-Origin", "*");
        } catch (FunstayException $e) {
            return response([
                'success' => false,
                'message' => $e->getMessage()
            ])->header("Access-Control-Allow-Origin", "*");
        } catch (FunstayQueryException $e) {
            return response([
                'success' => false,
                'message' => $e->getMessage()
            ])->header("Access-Control-Allow-Origin", "*");
        } catch (\Exception $e) {
            return response([
                'success' => false,
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ])->header("Access-Control-Allow-Origin", "*");
        }
    }

    public function updateProjectStatus($vendordetail_id, Request $request)
    {
        try {
            $data = [
                'fki_projectstatus_id' => $request->fki_projectstatus_id
            ];
            $response = VendorDetail::updateVendorDetails($vendordetail_id, $data);
            return response([
                'success' => true,
                'message' => 'OK',
                'data' => $response
            ])->header("Access-Control-Allow-Origin", "*");
        } catch (FunstayException $e) {
            return response([
                'success' => false,
                'message' => $e->getMessage()
            ])->header("Access-Control-Allow-Origin", "*");
        } catch (FunstayQueryException $e) {
            return response([
                'success' => false,
                'message' => $e->getMessage()
            ])->header("Access-Control-Allow-Origin", "*");
        } catch (\Exception $e) {
            return response([
                'success' => false,
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ])->header("Access-Control-Allow-Origin", "*");
        }
    }
}
