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
}
