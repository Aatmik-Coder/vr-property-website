<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property_Assigned extends Model
{
    use HasFactory;

    protected $table = 'properties_assigneds';

    protected $primaryKey = 'id';

    public function properties() {
        return $this->hasOne(Property::class, 'id', 'property_id');
    }

    public function agencies() {
        return $this->hasOne(Agency::class,'id','agency_id');
    }

    public function employees() {
        return $this->hasOne(Employee::class,'id','employee_id');
    }


    protected $fillable = [
        'property_id',
        'agency_id',
        'employee_id'
    ];
}
