<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Storage;

class Developer extends Authenticatable
{
    use HasFactory;

    protected $guard = 'developer';

    // public function getEmailName()
    // {
    //     return $this->person_email;
    // }

    public function getAuthPassword()
    {
        return $this->person_password;
    }

    protected $fillable = [
        'developer_name',
        'person_name',
        'person_email',
        'person_password',
        'person_mobile_number',
        'address',
        'country_id',
        'state_id',
        'city_id',
    ];
}
