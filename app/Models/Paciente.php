<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paciente extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'paciente';

    protected $fillable = [
        'nome',
        'cpf',
        'email',
        'telefone',
        'data_nascimento',
        'sexo',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
