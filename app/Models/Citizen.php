<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citizen extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'first_name',  'lastname', 'country', 'state', 'city', 'pincode',  'gender', 'aadhar_card', 'mobile_number', 'email', 'created_by', 'updated_by'
    ];

    protected $casts = [
        'id' => "string",
        'first_name' => "string"
    ];

    public function migrateDataOne()
    {
        return $this->hasOne(MigrateList::class);
    }

    public function migrateDataMany()
    {
        return $this->hasMany(MigrateList::class);
    }
}
