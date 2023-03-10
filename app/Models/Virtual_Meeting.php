<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Virtual_Meeting extends Model
{
    use HasFactory;

    protected $table = 'virtual__meetings';

    protected $primaryKey = 'id';

    protected $fillable = [
        'client_id',
        'actual_link',
        'demo_date',
        'demo_time',
        'expiry_time',
        'timezone'
    ];
}
