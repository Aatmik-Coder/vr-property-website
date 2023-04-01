<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property_Employee extends Model
{
    use HasFactory;

    protected $table = 'properties_employees';

    protected $primaryKey = 'id';

    public function properties() {
        return $this->hasOne(Property::class, 'id', 'property_id');
    }

    public function employees() {
        return $this->hasOne(Employee::class,'id','employee_id');
    }


    protected $fillable = [
        'property_id',
        'employee_id'
    ];
}
