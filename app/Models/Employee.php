<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

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
