<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citizen extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'first_name', 'middle_name', 'lastname', 'country', 'state', 'city', 'pincode', 'address', 'gender', 'aadhar_card', 'mobile_number', 'alternative_number', 'email'
    ];

    protected $casts = [
        'id' => "string",
        'first_name' => "string"
    ];
}
