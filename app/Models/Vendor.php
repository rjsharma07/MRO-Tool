<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $table = 'vendors';
    protected $primaryKey = 'pki_vendor_id';
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';

    public static function updateVendor($vendor_id, $data)
    {
        return Vendor::where('pki_vendor_id', $vendor_id)
                        ->update($data);
    }
}
