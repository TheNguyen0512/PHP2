<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'us_name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'us_email_verified_at' => 'datetime',
    ];

    public function roles(){
        return $this->belongsToMany(Roles::class,'role_users','user_id','role_id');
    }

    public function checkPermissionAccess($permissionCheck){
        $role = auth()->user()->roles;
        foreach ($role as $roleItem){
            $permission = $roleItem->permission;
            if ($permission ->contains('key_code', $permissionCheck)){
                return true;
            }
            return false;
        }
    }
}
