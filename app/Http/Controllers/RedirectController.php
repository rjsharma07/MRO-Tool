<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Client;
use App\Models\Currency;
use App\Models\User;
use App\Models\VendorDetail;
use App\Models\ProjectDetail;
use App\Models\VendorProjectDetail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class RedirectController extends Controller
{
    public function captureRedirect(Request $request, $urlId) {
        $pid = $request->get('pid');

        $status = $request->get('status');
        
        $projectOb = ProjectDetail::where('respondent_id', $pid)->first();
        $projectOb->fki_status_id = $status;
        $projectOb->exited = \Carbon\Carbon::now();
        $projectOb->updated = \Carbon\Carbon::now();
        $projectOb->save();

        $vendorOb = VendorProjectDetail::where('respondent_id', $pid)->first();
        $vendorOb->fki_status_id = $status;
        $vendorOb->exited = \Carbon\Carbon::now();
        $vendorOb->updated = \Carbon\Carbon::now();
        $vendorOb->save();
        
        $vendor = VendorDetail::where('pki_vendordetail_id', $vendorOb->fki_vendordetail_id)->first();

        switch($status) {
            case "1": 
                $project = Project::where('complete_url', 'like', '%/'.$urlId.'?status='.$status.'%')->first();
                $project->completes_count = $project->completes_count ? ++$project->completes_count : 1;
                $project->save();

                $vendor->completes_count = $vendor->completes_count ? ++$vendor->completes_count : 1;
                $vendor->save();

                // $response = Http::get($vendor->complete_url, [
                //     'pid' => $vendorOb->vendor_respondent_id
                // ]);
                return redirect()->route('projects.redirects.redirect', [
                    'status' => 'Complete'
                ]);
            case "2": 
                $project = Project::where('disqualify_url', 'like', '%/'.$urlId.'?status='.$status.'%')->first();
                $project->disqualify_count = $project->disqualify_count ? ++$project->disqualify_count : 1;
                $project->save();

                $vendor->disqualify_count = $vendor->disqualify_count ? ++$vendor->disqualify_count : 1;
                $vendor->save();

                $response = Http::get($vendor->disqualify_url, [
                    'pid' => $vendorOb->vendor_respondent_id
                ]);

                return redirect()->route('projects.redirects.redirect', [
                    'status' => 'Disqualify'
                ]);
            case "3": 
                $project = Project::where('quotafull_url', 'like', '%/'.$urlId.'?status='.$status.'%')->first();
                $project->quota_full_count = $project->quota_full_count ? ++$project->quota_full_count : 1;
                $project->save();

                $vendor->quota_full_count = $vendor->quota_full_count ? ++$vendor->quota_full_count : 1;
                $vendor->save();

                $response = Http::get($vendor->quotafull_url, [
                    'pid' => $vendorOb->vendor_respondent_id
                ]);

                return redirect()->route('projects.redirects.redirect', [
                    'status' => 'Quotafull'
                ]);
            case "4": 
                $project = Project::where('quality_term_url', 'like', '%/'.$urlId.'?status='.$status.'%')->first();
                $project->quality_term_count = $project->quality_term_count ? ++$project->quality_term_count : 1;
                $project->save();

                $vendor->quality_term_count = $vendor->quality_term_count ? ++$vendor->quality_term_count : 1;
                $vendor->save();
                
                $response = Http::get($vendor->quality_term_url, [
                    'pid' => $vendorOb->vendor_respondent_id
                ]);

                return redirect()->route('projects.redirects.redirect', [
                    'status' => 'Qualityterm'
                ]);

            default: break;
        }
    }

    public function redirectSurvey(Request $request, $urlId) {
        $pid = $request->get('pid');
        $vendorDetail = VendorDetail::where('survey_url', 'like', '%/survey/'.$urlId.'%')->first();
        $project = Project::where('pki_project_id', $vendorDetail->fki_project_id)->first();
        $completesCheck = ($vendorDetail->completes_count <= $vendorDetail->required_completes);
        $hitsCheck = ($vendorDetail->hits <= $vendorDetail->required_completes);
        $surveyCheck = ($vendorDetail->survey_check == 1) ? $completesCheck : $hitsCheck;
        if($project->fki_projectstatus_id == 2 && $vendorDetail->fki_projectstatus_id == 2 && $surveyCheck){
            //Increasing Project and VendorDetails Hits by 1
            $vendorDetail->project->hits++;
            $vendorDetail->project->save();
            $vendorDetail->hits++;
            $vendorDetail->project->save();

            //Generating tools unique Repondent Id 
            $projectRespId = "CRI_".mt_rand(1000000000, 9999999999);
            
            //Saving Record for Vendor Project Details
            $vendorOb = new VendorProjectDetail();
            $vendorOb->fki_project_id = $vendorDetail->fki_project_id;
            $vendorOb->fki_vendordetail_id = $vendorDetail->pki_vendordetail_id;
            $vendorOb->vendor_respondent_id = $pid;
            $vendorOb->respondent_id = $projectRespId;
            $vendorOb->entered = \Carbon\Carbon::now();
            $vendorOb->created = \Carbon\Carbon::now();
            $vendorOb->updated = \Carbon\Carbon::now();
            $vendorOb->save();

            //Saving Record for Project Details
            $projectOb = new ProjectDetail();
            $projectOb->fki_project_id = $vendorDetail->fki_project_id;
            $projectOb->fki_vendordetail_id = $vendorDetail->pki_vendordetail_id;
            $projectOb->fki_vendorprojectdetail_id = $vendorOb->pki_vendorprojectdetail_id;
            $projectOb->respondent_id = $projectRespId;
            $projectOb->entered = \Carbon\Carbon::now();
            $projectOb->created = \Carbon\Carbon::now();
            $projectOb->updated = \Carbon\Carbon::now();
            $projectOb->save();

            return redirect()->to($vendorDetail->project->client_survey_url.$projectRespId);
        }
        return redirect()->route('projects.redirects.redirect', [
            'status' => 'Unavailable'
        ]);
    }

    public function finalRedirect(Request $request){
        $status = $request->status;
        return view('projects.redirects.redirect', [
            'status' => $status
        ]);
    }

}
