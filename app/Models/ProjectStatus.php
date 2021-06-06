<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectStatus extends Model
{
    use HasFactory;

    protected $table = 'projectstatuses';
    protected $primaryKey = 'pki_projectstatus_id';
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
}
