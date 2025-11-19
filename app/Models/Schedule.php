<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'dia_semana',
        'hora',
    ];

    public function doctor()
    {
        return $this->belongsTo(\App\Models\Doctor::class);
    }
}
