<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorDetail extends Model
{
    use HasFactory;

    protected $table = 'vendordetails';
    protected $primaryKey = 'pki_vendordetail_id';
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';

    public function project() {
        return $this->belongsTo(Project::class, "fki_project_id");
    }

    public static function getVendorDetails(){
        return VendorDetail::select(
            'vendordetails.pki_vendordetail_id',
            'vendordetails.cpi as cpi',
            'vendordetails.hits',
            'vendordetails.required_completes',
            'vendordetails.completes_count',
            'vendordetails.survey_url',
            'vendordetails.complete_url',
            'vendordetails.disqualify_url',
            'vendordetails.quotafull_url',
            'vendordetails.quality_term_url',
            'vendordetails.created as created',
            'vendordetails.updated as updated',
            'vendors.vendor',
            'projects.pki_project_id as project_id',
            'projects.name as project_name'
        )
                            ->join(
                                'vendors',
                                'vendors.pki_vendor_id',
                                '=',
                                'vendordetails.fki_vendor_id'
                            )
                            ->join(
                                'projects',
                                'projects.pki_project_id',
                                '=',
                                'vendordetails.fki_project_id'
                            )
                            ->get();
    }

    public static function getVendorDetailsById($vendordetail_id){
        return VendorDetail::select(
            'vendordetails.pki_vendordetail_id',
            'vendordetails.cpi as cpi',
            'vendordetails.hits',
            'vendordetails.required_completes',
            'vendordetails.completes_count',
            'vendordetails.survey_url',
            'vendordetails.complete_url',
            'vendordetails.disqualify_url',
            'vendordetails.quotafull_url',
            'vendordetails.quality_term_url',
            'vendordetails.created as created',
            'vendordetails.updated as updated',
            'vendors.vendor',
            'projects.pki_project_id as project_id',
            'projects.name as project_name'
        )
                            ->join(
                                'vendors',
                                'vendors.pki_vendor_id',
                                '=',
                                'vendordetails.fki_vendor_id'
                            )
                            ->join(
                                'projects',
                                'projects.pki_project_id',
                                '=',
                                'vendordetails.fki_project_id'
                            )
                            ->where('pki_vendordetail_id', $vendordetail_id)
                            ->first();
    }

    public static function getVendorDetailsByProject($project_id){
        return VendorDetail::select(
            'vendordetails.pki_vendordetail_id',
            'vendordetails.fki_projectstatus_id',
            'vendordetails.cpi as cpi',
            'vendordetails.hits',
            'vendordetails.required_completes',
            'vendordetails.completes_count',
            'vendordetails.survey_url',
            'vendordetails.complete_url',
            'vendordetails.disqualify_url',
            'vendordetails.quotafull_url',
            'vendordetails.quality_term_url',
            'vendordetails.created as created',
            'vendordetails.updated as updated',
            'vendors.vendor',
            'projects.pki_project_id as project_id',
            'projects.name as project_name'
        )
                            ->join(
                                'vendors',
                                'vendors.pki_vendor_id',
                                '=',
                                'vendordetails.fki_vendor_id'
                            )
                            ->join(
                                'projects',
                                'projects.pki_project_id',
                                '=',
                                'vendordetails.fki_project_id'
                            )
                            ->where('fki_project_id', $project_id)
                            ->where('vendordetails.active', 1)
                            ->get();
    }

    public static function updateVendorDetails($vendordetail_id, $data)
    {
        return VendorDetail::where('pki_vendordetail_id', $vendordetail_id)
                        ->update($data);
    }
}
