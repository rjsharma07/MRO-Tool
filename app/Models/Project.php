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

    public function vendors() {
        return $this->hasMany(VendorDetail::class, "fki_project_id");
    }

    public function generateAlphaLinks($request) {
        
        $this->complete_url = $request->getHost()."/survey-response/alpha_url?status=1&pid=";
        $this->disqualify_url = $request->getHost()."/survey-response/alpha_url?status=2&pid=";
        $this->quotafull_url = $request->getHost()."/survey-response/alpha_url?status=3&pid=";
        $this->quality_term_url = $request->getHost()."/survey-response/alpha_url?status=4&pid=";

        return $this->save();
    }

    public function generateUniqueLinks($request) {
        
        $this->complete_url = $request->getHost()."/survey-response/".Str::uuid()."?status=1&pid=";
        $this->disqualify_url = $request->getHost()."/survey-response/".Str::uuid()."?status=2&pid=";
        $this->quotafull_url = $request->getHost()."/survey-response/".Str::uuid()."?status=3&pid=";
        $this->quality_term_url = $request->getHost()."/survey-response/".Str::uuid()."?status=4&pid=";

        return $this->save();
    }

    public static function getProjects(){
        return Project::select(
            'projects.pki_project_id',
            'projects.fki_projectstatus_id',
            'projects.name',
            'projects.subject',
            'projects.cui',
            'projects.loi',
            'projects.ir',
            'projects.cpi',
            'projects.required_completes',
            'projects.completes_count',
            'projects.disqualify_count',
            'projects.survey_visited_count',
            'projects.created',
            'projects.updated',
            'users.name as manager',
            'clients.pki_client_id',
            'clients.client',
            'clients.client',
            'countries.pki_country_id',
            'countries.country'
        )
                        ->join(
                            'users',
                            'users.pki_user_id',
                            '=',
                            'projects.fki_user_id'
                        )
                        ->join(
                            'clients',
                            'clients.pki_client_id',
                            '=',
                            'projects.fki_client_id'
                        )
                        ->join(
                            'countries',
                            'countries.pki_country_id',
                            '=',
                            'projects.fki_country_id'
                        )
                        ->where('projects.status', 1)
                        ->get(); 
    }

    public static function getProjectDetails($project_id){
        return Project::select(
            'projects.pki_project_id',
            'projects.fki_country_id',
            'projects.name',
            'projects.subject',
            'projects.loi',
            'projects.ir',
            'projects.cpi',
            'projects.required_completes',
            'projects.client_survey_url',
            'projects.completes_count',
            'projects.complete_url',
            'projects.disqualify_url',
            'projects.quotafull_url',
            'projects.quality_term_url',
            'users.name as user_name'
        )
                        ->join(
                            'users',
                            'users.pki_user_id',
                            '=',
                            'projects.fki_user_id'
                        )
                        ->where('pki_project_id', $project_id)
                        ->first(); 
    }

    public static function updateProjectDetails($project_id, $data)
    {
        return Project::where('pki_project_id', $project_id)
                        ->update($data);
    }

    public static function getProjectsByCUI($cui){
        return Project::select(
            'projects.pki_project_id',
            'projects.name',
            'projects.subject',
            'projects.cpi',
            'projects.created',
            'projects.updated',
        )
                        ->where('cui', $cui)
                        ->get(); 
    }
}
