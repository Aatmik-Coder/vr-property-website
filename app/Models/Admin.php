<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Model;
use Storage;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = "admin";

    protected $fillable = [ 'is_super', 'name', 'email', 'avatar', 'password', 'is_active' ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->reset_url = route('admin.password.reset', ['token' => $token, 'email' => $this->email]);
        $this->notify(new ResetPasswordNotification($this));
    }

    public function getAvatarUrlAttribute()
    {
        $url = asset("assets/common/images/default-avatar.png");
        if($this->avatar) {
            $url = Storage::url(config('constants.ADMIN_PATH').$this->avatar);
        }
        return $url;
    }

    public function getTypeAttribute()
    {
        $type = "Admin";
        if($this->is_super) {
            $type = "Super Admin";
        }
        return $type;
    }

}
