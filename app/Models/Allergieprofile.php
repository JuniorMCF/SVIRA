<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allergieprofile extends Model
{
    use HasFactory;

    protected $fillable = [
        'medicine',
        'id_user'
    ];

}
