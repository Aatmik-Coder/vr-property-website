<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;
use Laravel\Sanctum\HasApiTokens;
use Storage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    // use \Illuminate\Database\Eloquent\SoftDeletes;
    use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

    protected $softCascade = [
        'images@update',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id', 
        'is_developer', 
        'is_agency', 
        'is_employee', 
        'developer_id', 
        'agency_id', 
        'employee_id', 
        'avatar'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->reset_url = route('password.reset', ['token' => $token, 'email' => $this->email]);
        $this->notify(new ResetPasswordNotification($this));
    }

    public function getNameAttribute()
    {
        $name = $this->first_name;
        if($this->last_name) {
            $name .= ' '.$this->last_name;
        }
        return $name;
    }

    public function getAvatarUrlAttribute()
    {
        $url = asset("assets/common/images/default-avatar.png");
        if($this->avatar) {
            $url = Storage::url(config('constants.USER_PATH').$this->avatar);
        }
        return $url;
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' =>  'date'
    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
