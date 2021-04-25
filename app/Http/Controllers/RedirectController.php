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
        $inputs = $request->all();
        $count = count($inputs);
        foreach($inputs as $index=>$input){
            if($index == ($count-1)){
                $pid = $input;
            }
        }

        $status = $request->get('status');
        
        $projectOb = ProjectDetail::where('respondent_id', $pid)->first();
        $projectOb->fki_status_id = $status;
        $projectOb->save();

        $vendorOb = VendorProjectDetail::where('respondent_id', $pid)->first();
        $vendorOb->fki_status_id = $status;
        $vendorOb->save();

        $redirect = VendorDetail::where('pki_vendordetail_id', $vendorOb->fki_vendordetail_id)->first();

        switch($status) {
            case "1": 
                $project = Project::where('complete_url', 'like', '%/'.$urlId.'?status='.$status.'%')->first();
                $project->complete_count = $project->complete_count ? ++$project->complete_count : 1;
                $project->save();

                $response = Http::get($redirect->complete_url, [
                    'pid' => $vendorOb->vendor_respondent_id
                ]);

                break;
            case "2": 
                $project = Project::where('disqualify_url', 'like', '%/'.$urlId.'?status='.$status.'%')->first();
                $project->disqualify_count = $project->disqualify_count ? ++$project->disqualify_count : 1;
                $project->save();

                $response = Http::get($redirect->disqualify_url, [
                    'pid' => $vendorOb->vendor_respondent_id
                ]);

                break;
            case "3": 
                $project = Project::where('quotafull_url', 'like', '%/'.$urlId.'?status='.$status.'%')->first();
                $project->quota_full_count = $project->quota_full_count ? ++$project->quota_full_count : 1;
                $project->save();

                $response = Http::get($redirect->quotafull_url, [
                    'pid' => $vendorOb->vendor_respondent_id
                ]);

                break;
            case "4": 
                $project = Project::where('quality_term_url', 'like', '%/'.$urlId.'?status='.$status.'%')->first();
                $project->quality_term_count = $project->quality_term_count ? ++$project->quality_term_count : 1;
                $project->save();
                
                $response = Http::get($redirect->quality_term_url, [
                    'pid' => $vendorOb->vendor_respondent_id
                ]);

                break;

            default: break;
        }
    }

    public function redirectSurvey(Request $request, $urlId) {
        $inputs = $request->all();
        $count = count($inputs);
        foreach($inputs as $index=>$input){
            if($index == ($count-1)){
                $pid = $input;
            }
        }
        
        $vendorDetail = VendorDetail::where('survey_url', 'like', '%/survey/'.$urlId.'%')->first();
        $vendorDetail->project->survey_visited_count = $vendorDetail->project->survey_visited_count ? ++$vendorDetail->project->survey_visited_count : 1;
        $vendorDetail->project->hits = $vendorDetail->project->hits ? ++$vendorDetail->project->hits : 1;
        $vendorDetail->project->save();

        $projectRespId = mt_rand(1000000000, 9999999999);
        
        $vendorOb = new VendorProjectDetail();
        $vendorOb->fki_project_id = $vendorDetail->fki_project_id;
        $vendorOb->fki_vendordetail_id = $vendorDetail->pki_vendordetail_id;
        $vendorOb->vendor_respondent_id = $pid;
        $vendorOb->respondent_id = $projectRespId;
        $vendorOb->created = \Carbon\Carbon::now();
        $vendorOb->updated = \Carbon\Carbon::now();
        $vendorOb->save();

        $projectOb = new ProjectDetail();
        $projectOb->fki_project_id = $vendorDetail->fki_project_id;
        $projectOb->fki_vendordetail_id = $vendorDetail->pki_vendordetail_id;
        $projectOb->fki_vendorprojectdetail_id = $vendorOb->pki_vendorprojectdetail_id;
        $projectOb->respondent_id = $projectRespId;
        $projectOb->created = \Carbon\Carbon::now();
        $projectOb->updated = \Carbon\Carbon::now();
        $projectOb->save();

        return redirect()->to($vendorDetail->project->client_survey_url.$projectRespId);
    }
}
