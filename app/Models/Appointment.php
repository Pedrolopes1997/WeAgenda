<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'doctor_id',
        'nome_paciente',
        'cpf_paciente',
        'email_paciente',
        'telefone_paciente',
        'data',
        'hora',
        'status',
    ];
    
public function doctor()
{
    return $this->belongsTo(\App\Models\Doctor::class);
}

}
