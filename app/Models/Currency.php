<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $table = 'currencies';
    protected $primaryKey = 'pki_currency_id';
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';

    public static function addCurrencies($data)
    {
        return Currency::insert($data);
    }
}
