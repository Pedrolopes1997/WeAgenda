<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Doctor;

class ScheduleController extends Controller
{
    public function index()
    {
        $horarios = Schedule::with('doctor')->orderBy('dia_semana')->orderBy('hora')->get();
        return view('admin.schedules.index', compact('horarios'));
    }

    public function create()
    {
        $medicos = \App\Models\Doctor::all();
        return view('admin.schedules.create', compact('medicos'));
    }

public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'dia_semana' => 'required|integer|min:0|max:6',
            'hora' => 'required',
        ]);
    
        Schedule::create([
            'doctor_id' => $request->doctor_id,
            'dia_semana' => $request->dia_semana,
            'hora' => $request->hora
        ]);
    
        return redirect()->route('schedules.index')->with('success', 'Horário cadastrado com sucesso!');
    }
}
