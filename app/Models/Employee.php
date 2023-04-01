<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Storage;

class Employee extends Authenticatable
{
    use HasFactory;

    protected $guard = 'employee';

    public function getAuthPassword()
    {
        return $this->person_password;
    }

    protected $fillable = [
        'employee_name',
        'person_name',
        'person_email',
        'person_password',
        'person_phone_number',
        'address',
        'country_id',
        'state_id',
        'city_id'
    ];
}
