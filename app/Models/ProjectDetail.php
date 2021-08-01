<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDetail extends Model
{
    use HasFactory;

    protected $table = 'projectdetails';
    protected $primaryKey = 'pki_projectdetail_id';
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';

    public static function getProjectLOI($project_id){
        return ProjectDetail::select(
            'projectdetails.pki_projectdetail_id',
            'projectdetails.entered',
            'projectdetails.exited'
        )
                        ->where('fki_project_id', $project_id)
                        ->whereNotNull('entered')
                        ->whereNotNull('exited')
                        ->get(); 
    }

    public static function getProjectIds($project_id){
        return ProjectDetail::select(
            'projectdetails.pki_projectdetail_id',
            'projectdetails.respondent_id'
        )
                        ->where('fki_project_id', $project_id)
                        ->where('fki_status_id', 1)
                        ->get(); 
    }

    public static function getProjectsByRespondentId($respondent_id){
        return ProjectDetail::select(
            'projectdetails.pki_projectdetail_id',
            'projectdetails.respondent_id',
            'projects.pki_project_id as project_id',
            'projects.name'
        )
                        ->join(
                            'projects',
                            'projects.pki_project_id',
                            '=',
                            'projectdetails.fki_project_id'
                        )
                        ->where('respondent_id', $respondent_id)
                        ->first(); 
    }

    public static function getProjectIdsReceived($project_id){
        return ProjectDetail::select(
            'projectdetails.pki_projectdetail_id',
            'projectdetails.respondent_id',
            'projects.pki_project_id as project_id',
            'projects.name',
            'projects.cpi',
        )
                        ->join(
                            'projects',
                            'projects.pki_project_id',
                            '=',
                            'projectdetails.fki_project_id'
                        )
                        ->where('projectdetails.fki_project_id', $project_id)
                        ->where('projectdetails.active', 0)
                        ->get(); 
    }

    public static function updateProjectDetailStatus($project_detail_id, $data){
        return ProjectDetail::where('pki_projectdetail_id', $project_detail_id)
                        ->update($data);
    }
}
