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
        'payments@update',
    ];

    protected $fillable = [
        'user_id', 'title', 'description', 'location', 'file_name', 'height', 'width', 'size', 'paid_start_date', 'paid_end_date', 'status', 'is_paid', 'is_active'
    ];

    public function getImageUrlAttribute()
    {
        $url = asset("assets/common/images/no-img.png");
        if($this->avatar) {
            $url = Storage::url(config('constants.ADMIN_PATH').$this->avatar);
        }
        return $url;
    }

    public function tags()
    {
        return $this->hasMany(ImageTag::class);
    }

    public function payments()
    {
        return $this->hasMany(ImagePayment::class);
    }
}
