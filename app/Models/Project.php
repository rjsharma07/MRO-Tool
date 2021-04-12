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
        
        $this->complete_url = $request->getHost()."/survey-response/".Str::uuid()."?&status=1&pid=";
        $this->disqualify_url = $request->getHost()."/survey-response/".Str::uuid()."?&status=2&pid=";
        $this->quotafull_url = $request->getHost()."/survey-response/".Str::uuid()."?&status=3&pid=";
        $this->quality_term_url = $request->getHost()."/survey-response/".Str::uuid()."?&status=4&pid=";

        return $this->save();
    }

}
