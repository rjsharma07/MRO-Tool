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
}
