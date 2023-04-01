<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Properties_image extends Model
{
    use HasFactory;

    protected $table = 'properties_images';

    protected $primaryKey = 'id';

    protected $fillable = [
        'property_id',
        'image_name'
    ];
}
