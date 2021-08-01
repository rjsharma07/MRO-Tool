<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';
    protected $primaryKey = 'pki_client_id';
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';

    public static function updateClient($client_id, $data)
    {
        return Client::where('pki_client_id', $client_id)
                        ->update($data);
    }
}
