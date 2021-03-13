<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Project extends Model
{   
    use HasFactory;

    protected $table = 'projects';
    protected $primaryKey = 'pki_project_id';
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';

    public static function getProjects(){
        $project = Project::all();
        return $project;
    }

    public function generateAlphaLinks($request) {
        
        $this->complete_url = $request->getHost()."/survey-response/alpha_url/complete";
        $this->disqualify_url = $request->getHost()."/survey-response/alpha_url/disqualify";
        $this->quotafull_url = $request->getHost()."/survey-response/alpha_url/quota-full";
        $this->quality_term_url = $request->getHost()."/survey-response/alpha_url/quality-term";

        return $this->save();
    }

    public function generateUniqueLinks($request) {
        
        $this->complete_url = $request->getHost()."/survey-response/".Str::uuid()."/complete";
        $this->disqualify_url = $request->getHost()."/survey-response/".Str::uuid()."/disqualify";
        $this->quotafull_url = $request->getHost()."/survey-response/".Str::uuid()."/quota-full";
        $this->quality_term_url = $request->getHost()."/survey-response/".Str::uuid()."/quality-term";

        return $this->save();
    }

    public function maskSurvey($request) {
        
        $urlToken = Str::uuid();

        $this->client_survey_url = $request->getHost()."/survey/".$urlToken;

        return $this->save();
    }
}
