<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $table = "properties";

    protected $primaryKey = "id";

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
