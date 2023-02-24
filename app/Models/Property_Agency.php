<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property_Agency extends Model
{
    use HasFactory;

    protected $table = 'properties_agencies';

    protected $primaryKey = 'id';

    public function properties() {
        return $this->hasOne(Property::class, 'id', 'property_id');
    }

    public function agencies() {
        return $this->hasOne(Agency::class,'id','agency_id');
    }


    protected $fillable = [
        'property_id',
        'agency_id'
    ];
}
