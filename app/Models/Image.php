<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    use \Illuminate\Database\Eloquent\SoftDeletes;
    use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

    protected $softCascade = [
        'tags@update',
    ];

    protected $fillable = [
        'user_id', 'title', 'description', 'location', 'file_name', 'height', 'width', 'size', 'amount', 'final_amount', 'discount', 'discount_code', 'discount_per', 'payment_id', 'status', 'is_paid', 'is_active'
    ];

    public function tags()
    {
        return $this->hasMany(ImageTag::class);
    }
}
