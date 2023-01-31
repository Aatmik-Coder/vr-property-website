<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagePayment extends Model
{
    use HasFactory;
    use \Illuminate\Database\Eloquent\SoftDeletes;
    use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

    protected $fillable = [
        'image_id', 'final_amount', 'amount', 'discount', 'discount_code', 'discount_per', 'payment_id', 'paid_start_date', 'paid_end_date'
    ];

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
