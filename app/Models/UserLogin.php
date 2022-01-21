<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class UserLogin extends Model
{
    use HasApiTokens;
    protected $fillable = [
        'email',
        'password',
        'user_id',
        'created_by',
        'updated_by',
    ];
}
