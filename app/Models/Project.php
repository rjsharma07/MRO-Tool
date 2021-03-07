<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Project extends Model
{   
    use HasFactory;

    protected $table = 'projects';
    protected $primaryKey = 'id';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public static function getProjects(){
        $project = Project::all();
        return $project;
    }

    public function generateLinks($request, $unique = false) {
        
        $urlToken = Str::uuid();

        $this->complete_url = $request->getHost().$urlToken."/complete";
        $this->disqualify_url = $request->getHost().$urlToken."/disqualify";
        $this->quotafull_url = $request->getHost().$urlToken."/quota-full";
        $this->quality_term_url = $request->getHost().$urlToken."/quality-term";

        return $this->save();
    }

    public function maskSurvey($request) {
        
        $urlToken = Str::uuid();

        $this->client_survey_url = $request->getHost()."/survey/".$urlToken;

        return $this->save();
    }
}
