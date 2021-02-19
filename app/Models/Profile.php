<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'height',
        'weight',
        'phone_number',    
        'address',
        'reference',
    //foreign key with users table
        'user_id',
        'especialidad',
    ];

}
