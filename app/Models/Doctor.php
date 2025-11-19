<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'crm',
        'email',
        'specialty_id',
        'hospital_id',
    ];

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
    
    public function schedules()
    {
        return $this->hasMany(\App\Models\Schedule::class);
    }

}
