<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRefreshToken extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'refresh_token',
        'user_id',
        'refresh_token_exp_time',
    ];
}
