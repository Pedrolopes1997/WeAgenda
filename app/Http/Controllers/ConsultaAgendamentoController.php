<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Session;

class ConsultaAgendamentoController extends Controller
{
    
    public function index()
    {
        $cpf = session('cpf_paciente');
    
        if ($cpf) {
            // Se o CPF estiver salvo na sessão, buscar automaticamente
            $agendamentos = \App\Models\Appointment::with(['doctor.specialty'])
                ->where('cpf_paciente', $cpf)
                ->orderBy('data')
                ->get();
    
            $agendamentosFuturos = $agendamentos->filter(function ($item) {
                return \Carbon\Carbon::parse($item->data)->isToday() || \Carbon\Carbon::parse($item->data)->isFuture();
            });
    
            $agendamentosPassados = $agendamentos->filter(function ($item) {
                return \Carbon\Carbon::parse($item->data)->isPast() && !\Carbon\Carbon::parse($item->data)->isToday();
            });
    
            return view('consulta.resultado', compact('agendamentosFuturos', 'agendamentosPassados'));
        }
    
        return view('consulta.index');
    }
        
    public function buscar(Request $request)
    {
        $request->validate([
            'cpf_paciente' => 'required'
        ]);
    
        session(['cpf_paciente' => $request->cpf_paciente]);
    
        $agendamentos = Appointment::with(['doctor.specialty'])
            ->where('cpf_paciente', $request->cpf_paciente)
            ->orderBy('data')
            ->get();
    
        $agendamentosFuturos = $agendamentos->filter(function ($item) {
            return \Carbon\Carbon::parse($item->data)->isToday() || \Carbon\Carbon::parse($item->data)->isFuture();
        });
    
        $agendamentosPassados = $agendamentos->filter(function ($item) {
            return \Carbon\Carbon::parse($item->data)->isPast() && !\Carbon\Carbon::parse($item->data)->isToday();
        });
    
        return view('consulta.resultado', compact('agendamentosFuturos', 'agendamentosPassados'));
    }
                                        
    public function cancelar($id)
    {
        $agendamento = \App\Models\Appointment::findOrFail($id);
    
        if ($agendamento->status != 'cancelado') {
            $agendamento->status = 'cancelado';
            $agendamento->save();
        }
    
        return redirect()->route('consulta.index')->with('success', 'Agendamento cancelado com sucesso!');
    }
        
    public function resultado()
    {
        $cpf = session('cpf_temp');
    
        if (!$cpf) {
            return redirect()->route('consulta.index')->with('error', 'CPF não encontrado.');
        }
    
        $agendamentos = \App\Models\Appointment::with(['doctor.specialty'])
            ->where('cpf_paciente', $cpf)
            ->orderBy('data')
            ->get();
    
        return view('consulta.resultado', compact('agendamentos'));
    }
        
    public function reagendar($id)
    {
        $agendamento = \App\Models\Appointment::findOrFail($id);
        $medicos = \App\Models\Doctor::all();
    
        return view('consulta.reagendar', compact('agendamento', 'medicos'));
    }
    
    public function salvarReagendamento(Request $request, $id)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'data' => 'required|date|after_or_equal:today',
            'hora' => 'required'
        ]);
    
        $agendamentoAntigo = \App\Models\Appointment::findOrFail($id);
    
        \App\Models\Appointment::create([
            'doctor_id' => $request->doctor_id,
            'nome_paciente' => $agendamentoAntigo->nome_paciente,
            'cpf_paciente' => $agendamentoAntigo->cpf_paciente,
            'email_paciente' => $agendamentoAntigo->email_paciente,
            'telefone_paciente' => $agendamentoAntigo->telefone_paciente,
            'data' => $request->data,
            'hora' => $request->hora,
            'status' => 'agendado'
        ]);
    
        return redirect()->route('consulta.index')->with('success', 'Novo agendamento realizado com sucesso!');
    }
}