<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorProjectDetail extends Model
{
    use HasFactory;
    
    protected $table = 'vendorprojectdetails';
    protected $primaryKey = 'pki_vendorprojectdetail_id';
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';

    public static function getVendorProjectDetailsLOI($vendordetail_id){
        return VendorProjectDetail::select(
            'vendorprojectdetails.pki_vendorprojectdetail_id',
            'vendorprojectdetails.entered',
            'vendorprojectdetails.exited'
        )
                        ->where('fki_vendordetail_id', $vendordetail_id)
                        ->whereNotNull('entered')
                        ->whereNotNull('exited')
                        ->get(); 
    }
}
