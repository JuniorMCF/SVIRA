<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacineprofile extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'nombre_paciente',
        'nombre_doctor',
        'id_vaccine',
        'tipo_inmun',
        'dosis',    
        'hospital',
        'fec_inmun',
    ];
}
