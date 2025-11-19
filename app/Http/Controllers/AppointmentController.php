<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Specialty;
use App\Mail\ConfirmacaoAgendamentoMail;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class AppointmentController extends Controller
{
    public function create()
    {
        $especialidades = Specialty::all();
        return view('appointments.create', compact('especialidades'));
    }

    public function getDoctors(Request $request)
    {
        $doctors = Doctor::where('specialty_id', $request->specialty_id)->get();
        return response()->json($doctors);
    }

public function store(Request $request)
{
    $request->validate([
        'doctor_id' => 'required|exists:doctors,id',
        'nome_paciente' => 'required|string|max:255',
        'cpf_paciente' => 'required|string|max:14',
        'email_paciente' => 'nullable|email',
        'telefone_paciente' => 'nullable|string|max:20',
        'data' => 'required|date',
        'hora' => 'required',
    ]);

    $agendamento = Appointment::create([
        'doctor_id' => $request->doctor_id,
        'nome_paciente' => $request->nome_paciente,
        'cpf_paciente' => $request->cpf_paciente,
        'email_paciente' => $request->email_paciente,
        'telefone_paciente' => $request->telefone_paciente,
        'data' => $request->data,
        'hora' => $request->hora,
        'status' => 'agendado',
    ]);

    // Se tiver e-mail do paciente, envia
    if (!empty($agendamento->email_paciente)) {
        Mail::to($agendamento->email_paciente)->send(new ConfirmacaoAgendamentoMail($agendamento));
    }

    // Agora decide: público ou hospital?
    if (Auth::check()) {
        // Se está logado (hospital/admin)
        return redirect()->route('appointments.index')->with('success', 'Agendamento realizado com sucesso!');
    } else {
        // Se é paciente (não logado)
        return view('appointments.public_success');
    }
}
    
    public function index(Request $request)
    {
        $query = \App\Models\Appointment::with(['doctor.specialty']);
    
        if ($request->filled('doctor_id')) {
            $query->where('doctor_id', $request->doctor_id);
        }
    
        if ($request->filled('specialty_id')) {
            $query->whereHas('doctor', function($q) use ($request) {
                $q->where('specialty_id', $request->specialty_id);
            });
        }
    
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
    
        if ($request->filled('data_inicio')) {
            $query->whereDate('data', '>=', $request->data_inicio);
        }
    
        if ($request->filled('data_fim')) {
            $query->whereDate('data', '<=', $request->data_fim);
        }
    
        $agendamentos = $query->orderBy('data')->paginate(15);
        $medicos = \App\Models\Doctor::all();
        $especialidades = \App\Models\Specialty::all();
    
        return view('admin.appointments.index', compact('agendamentos', 'medicos', 'especialidades'));
    }
        
    public function getAvailableTimes(Request $request)
    {
        $doctorId = $request->doctor_id;
        $data = $request->data;
    
        if (!$doctorId || !$data) {
            return response()->json([]);
        }
    
        // dia da semana em português (segunda, terca, etc.)
        $diaSemana = \Carbon\Carbon::parse($data)->dayOfWeek;
    
        // horários disponíveis cadastrados
        $horariosFixos = \App\Models\Schedule::where('doctor_id', $doctorId)
            ->where('dia_semana', $diaSemana)
            ->pluck('hora')
            ->toArray();
    
        // horários já ocupados para esse médico e data
        $ocupados = \App\Models\Appointment::where('doctor_id', $doctorId)
            ->where('data', $data)
            ->pluck('hora')
            ->toArray();
    
        // filtra horários ainda livres
        $disponiveis = array_values(array_diff($horariosFixos, $ocupados));
    
        return response()->json($disponiveis);
    }
        
    public function confirm($id)
    {
        $agendamento = \App\Models\Appointment::findOrFail($id);
    
        if ($agendamento->status == 'agendado') {
            $agendamento->status = 'confirmado';
            $agendamento->save();
        }
    
        return redirect()->back()->with('success', 'Agendamento confirmado com sucesso!');
    }
        
    public function cancel($id)
    {
        $agendamento = \App\Models\Appointment::findOrFail($id);
    
        if ($agendamento->status == 'agendado') {
            $agendamento->status = 'cancelado';
            $agendamento->save();
        }
    
        return redirect()->back()->with('success', 'Agendamento cancelado com sucesso!');
    }
        
    public function export(Request $request)
    {
        return Excel::download(new \App\Exports\AppointmentsExport($request), 'agendamentos_filtrados.xlsx');
    }
        
    public function exportPdf(Request $request)
    {
        $query = \App\Models\Appointment::with(['doctor.specialty']);
    
        if ($request->filled('doctor_id')) {
            $query->where('doctor_id', $request->doctor_id);
        }
    
        if ($request->filled('specialty_id')) {
            $query->whereHas('doctor', function($q) use ($request) {
                $q->where('specialty_id', $request->specialty_id);
            });
        }
    
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
    
        if ($request->filled('data_inicio')) {
            $query->whereDate('data', '>=', $request->data_inicio);
        }
    
        if ($request->filled('data_fim')) {
            $query->whereDate('data', '<=', $request->data_fim);
        }
    
        $agendamentos = $query->orderBy('data')->get();
    
        $pdf = Pdf::loadView('admin.appointments.pdf', compact('agendamentos'));
    
        return $pdf->download('agendamentos_filtrados.pdf');
    }
}
