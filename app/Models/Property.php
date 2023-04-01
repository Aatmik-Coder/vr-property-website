<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $table = "properties";

    protected $primaryKey = "id";

    public function countries() {
        return $this->hasOne(Country::class,'id','country_id');
    }

    public function states() {
        return $this->hasOne(State::class,'id','state_id');
    }

    public function cities() {
        return $this->hasOne(City::class,'id','city_id');
    }

    protected $fillable = [
        'developer_id',
        'country_id',
        'state_id',
        'city_id',
        'project_name',
        'unit_type',
        'type_of_building',
        'unit_number',
        'size',
        'price',
        'description',
        'image_name'
    ];
}
