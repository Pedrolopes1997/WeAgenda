<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Specialty;
use App\Models\Hospital;

class DoctorController extends Controller
{
    public function index()
    {
        $medicos = Doctor::with(['specialty', 'hospital'])->get();
        return view('admin.doctors.index', compact('medicos'));
    }

    public function create()
    {
        $especialidades = Specialty::all();
        // Por enquanto pegamos sempre o primeiro hospital (você pode adaptar isso depois por login)
        $hospital = Hospital::first();
        return view('admin.doctors.create', compact('especialidades', 'hospital'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'crm' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'specialty_id' => 'required|exists:specialties,id',
            'hospital_id' => 'required|exists:hospitals,id',
        ]);

        Doctor::create($request->all());

        return redirect()->route('doctors.index')->with('success', 'Médico cadastrado com sucesso!');
    }
}
