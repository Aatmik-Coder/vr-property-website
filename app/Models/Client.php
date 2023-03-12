<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    // public function virtualmeetings() {
    //     return $this->hasOne(Virtual_Meeting::class, 'client_id','id');
    // }

    protected $table = 'clients';

    protected $primaryKey = 'id';

    protected $fillable = [
        'property_id',
        'type_of_admin',
        'admin_id',
        'name',
        'email',
        'phone_number',
        'country_id',
        'state_id',
        'city_id',
        'address',
        'upload_document'
    ];
}
