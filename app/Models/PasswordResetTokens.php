<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordResetTokens extends Model
{

    protected $primaryKey = 'email';

    public $incrementing = false;

    protected $fillable = [
        'email', 'token',
    ];

    protected $casts = [
        'email' => 'string',
        'token' => 'string',
        'created_at' => 'datetime',
    ];
}
