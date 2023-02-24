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
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */


    public function developers() {
        return $this->hasOne(Developer::class, 'id','developer_id');
    }

    public function agencies(){
        return $this->hasOne(Agency::class, 'id','agency_id');
    }

    public function employees() {
        return $this->hasOne(Employee::class, 'id','employee_id');
    }

    public function roles() {
        return $this->hasOne(Role::class, 'id','role_id');
    }

    protected $tables = 'users';

    protected $primaryKey = 'id';

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
}
