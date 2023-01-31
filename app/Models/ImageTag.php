<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageTag extends Model
{
    use HasFactory;
    use \Illuminate\Database\Eloquent\SoftDeletes;
    use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

    protected $fillable = [
        'image_id', 'name'
    ];

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
