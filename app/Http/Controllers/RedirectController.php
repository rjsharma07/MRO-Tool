<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Client;
use App\Models\Currency;
use App\Models\User;
use App\Models\VendorDetail;

class RedirectController extends Controller
{
    public function captureRedirect(Request $request, $urlId, $status) {

        switch($status) {
            case "complete": 
                $project = Project::where('complete_url', 'like', '%/'.$urlId.'/'.$status.'%')->first();
                $project->complete_count = $project->complete_count ? ++$project->complete_count : 1;
                $project->save();
                break;
            case "disqualify": 
                $project = Project::where('disqualify_url', 'like', '%/'.$urlId.'/'.$status.'%')->first();
                $project->disqualify_count = $project->disqualify_count ? ++$project->disqualify_count : 1;
                $project->save();
                break;
            case "quota-full": 
                $project = Project::where('quotafull_url', 'like', '%/'.$urlId.'/'.$status.'%')->first();
                $project->quota_full_count = $project->quota_full_count ? ++$project->quota_full_count : 1;
                $project->save();
                break;
            case "quality-term": 
                $project = Project::where('quality_term_url', 'like', '%/'.$urlId.'/'.$status.'%')->first();
                $project->quality_term_count = $project->quality_term_count ? ++$project->quality_term_count : 1;
                $project->save();
                break;
            default: break;
        }
    }

    public function redirectSurvey(Request $request, $urlId) {
        $vendorDetail = VendorDetail::where('survey_url', 'like', '%/survey/'.$urlId.'%')->first();
        $vendorDetail->project->survey_visited_count = $vendorDetail->project->survey_visited_count ? ++$vendorDetail->project->survey_visited_count : 1;
        $vendorDetail->project->hits = $vendorDetail->project->hits ? ++$vendorDetail->project->hits : 1;
        $vendorDetail->project->save();

        return redirect()->to($vendorDetail->project->client_survey_url);
    }
}
