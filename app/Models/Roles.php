<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $primaryKey = 'rol_id';
    protected $fillable = ['rol_id', 'rol_name', 'rol_display_name'];
    public function permission(){
        return $this->belongsToMany(Permission::class,'permission_role','role_id','permission_id');
    }
}
