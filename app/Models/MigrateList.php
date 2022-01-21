<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MigrateList extends Model
{
    use HasFactory;

    protected $fillable = [
        'citizen_id',
        'migrate_state_id',
        'status',
        'approved_by',
    ];

    function citizenData()
    {
        return $this->hasMany(Citizen::class);
    }
}
