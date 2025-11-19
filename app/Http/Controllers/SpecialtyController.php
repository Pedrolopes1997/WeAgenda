<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialty;

class SpecialtyController extends Controller
{
    public function index()
    {
        $especialidades = Specialty::all();
        return view('admin.specialties.index', compact('especialidades'));
    }

    public function create()
    {
        return view('admin.specialties.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255'
        ]);

        Specialty::create($request->only('nome'));
        return redirect()->route('specialties.index')->with('success', 'Especialidade cadastrada com sucesso!');
    }
}
