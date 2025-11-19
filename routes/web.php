<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\PacienteAuthController;
use App\Models\DemoRequest;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Schedule;
use App\Models\Specialty;
use App\Mail\DemoRequestMail;
use App\Mail\ConsultaReagendadaMail;
use App\Exports\DemoRequestsExport;
use Maatwebsite\Excel\Facades\Excel;

// Página inicial
Route::get('/', function () {
    return view('welcome');
});

// Login/Logout Geral
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Solicitar Demonstração
Route::get('/demo', function () {
    return view('demo');
});

Route::post('/demo/submit', function (\Illuminate\Http\Request $request) {
    $lead = DemoRequest::create($request->only('nome', 'email', 'telefone', 'hospital'));
    Mail::to('agendamento@wcic.com.br')->send(new DemoRequestMail($lead));
    return back()->with('success', 'Solicitação enviada com sucesso! Entraremos em contato.');
});

// Auth Paciente
Route::get('/paciente/login', [PacienteAuthController::class, 'showLoginForm'])->name('paciente.login');
Route::post('/paciente/login', [PacienteAuthController::class, 'login']);
Route::get('/paciente/registro', [PacienteAuthController::class, 'showRegisterForm'])->name('paciente.register');
Route::post('/paciente/registro', [PacienteAuthController::class, 'register']);

// Paciente - Privado
Route::middleware('auth:paciente')->group(function () {

    Route::post('/paciente/logout', [PacienteAuthController::class, 'logout'])->name('paciente.logout');

    // Dashboard
    Route::get('/paciente/dashboard', function () {
        $pacienteEmail = auth()->guard('paciente')->user()->email;
        $agendamentosConfirmados = Appointment::where('email_paciente', $pacienteEmail)->where('status', 'confirmado')->count();
        $agendamentosCancelados = Appointment::where('email_paciente', $pacienteEmail)->where('status', 'cancelado')->count();
        $proximaConsulta = Appointment::where('email_paciente', $pacienteEmail)
            ->where('status', 'confirmado')
            ->whereDate('data', '>=', Carbon::today())
            ->orderBy('data')->orderBy('hora')->first();
        return view('paciente.dashboard', compact('agendamentosConfirmados', 'agendamentosCancelados', 'proximaConsulta'));
    })->name('paciente.dashboard');

    // Ver Agendamentos
    Route::get('/paciente/agendamentos', function () {
        $pacienteEmail = auth()->guard('paciente')->user()->email;
        $agendamentos = Appointment::where('email_paciente', $pacienteEmail)
            ->orderBy('data', 'desc')
            ->get()
            ->map(function ($item) {
                $item->medico_nome = Doctor::find($item->doctor_id)?->nome ?? 'Médico não encontrado';
                return $item;
            });
        return view('paciente.agendamentos', compact('agendamentos'));
    })->name('paciente.agendamentos');

    // Cancelar Agendamento
    Route::post('/paciente/agendamentos/{id}/cancelar', function ($id) {
        $agendamento = Appointment::findOrFail($id);
        if ($agendamento->email_paciente != auth()->guard('paciente')->user()->email) {
            abort(403);
        }
        $agendamento->status = 'cancelado';
        $agendamento->save();
        return redirect('/paciente/agendamentos')->with('success', 'Agendamento cancelado com sucesso.');
    })->name('paciente.agendamentos.cancelar');

    // Agendar Nova Consulta
    Route::get('/paciente/agendar', function () {
        $especialidades = Specialty::all();
        return view('paciente.agendar', compact('especialidades'));
    })->name('paciente.agendar');

    Route::post('/paciente/agendar', function (\Illuminate\Http\Request $request) {
        $request->validate([
            'specialty_id' => 'required|exists:specialties,id',
            'doctor_id' => 'required|exists:doctors,id',
            'data' => 'required|date',
            'hora' => 'required',
        ]);

        $paciente = auth()->guard('paciente')->user();

        $horarioOcupado = Appointment::where('doctor_id', $request->doctor_id)
            ->where('data', $request->data)
            ->where('hora', $request->hora)
            ->exists();

        if ($horarioOcupado) {
            return back()->withErrors(['hora' => 'Este horário já foi agendado.']);
        }

        Appointment::create([
            'doctor_id' => $request->doctor_id,
            'nome_paciente' => $paciente->nome,
            'cpf_paciente' => $paciente->cpf,
            'email_paciente' => $paciente->email,
            'telefone_paciente' => $paciente->telefone,
            'data' => $request->data,
            'hora' => $request->hora,
            'status' => 'confirmado',
        ]);

        return redirect('/paciente/agendamentos')->with('success', 'Consulta agendada com sucesso!');
    });

    // Detalhes da Consulta
    Route::get('/paciente/agendamento/{id}', function ($id) {
        $agendamento = Appointment::findOrFail($id);
        if ($agendamento->email_paciente !== auth()->guard('paciente')->user()->email) {
            abort(403);
        }
        return view('paciente.agendamento-detalhes', compact('agendamento'));
    })->name('paciente.agendamento.detalhes');

    // Reagendar Consulta (GET)
    Route::get('/paciente/agendamento/{id}/reagendar', function ($id) {
        $agendamento = Appointment::findOrFail($id);
        if ($agendamento->email_paciente !== auth()->guard('paciente')->user()->email) {
            abort(403);
        }
        return view('paciente.agendamento-reagendar', compact('agendamento'));
    })->name('paciente.agendamento.reagendar');

    // Reagendar Consulta (POST)
    Route::post('/paciente/agendamento/{id}/reagendar', function ($id, \Illuminate\Http\Request $request) {
        $agendamento = Appointment::findOrFail($id);
        if ($agendamento->email_paciente !== auth()->guard('paciente')->user()->email) {
            abort(403);
        }

        $request->validate([
            'data' => 'required|date',
            'hora' => 'required',
        ]);

        $horarioOcupado = Appointment::where('doctor_id', $agendamento->doctor_id)
            ->where('data', $request->data)
            ->where('hora', $request->hora)
            ->where('status', 'confirmado')
            ->exists();

        if ($horarioOcupado) {
            return back()->withErrors(['hora' => 'Este horário já está ocupado.']);
        }

        $agendamento->data = $request->data;
        $agendamento->hora = $request->hora;
        $agendamento->save();

        Mail::to($agendamento->email_paciente)->send(new ConsultaReagendadaMail($agendamento));

        return redirect('/paciente/agendamentos')->with('success', 'Consulta reagendada com sucesso!');
    })->name('paciente.agendamento.reagendar.salvar');

});

// APIs p/ Paciente (AJAX)
Route::middleware('auth:paciente')->group(function () {
    Route::get('/api/medicos-especialidade/{specialty_id}', function ($specialty_id) {
        return Doctor::where('specialty_id', $specialty_id)->get(['id', 'nome']);
    });

    Route::get('/api/horarios-disponiveis/{doctor_id}/{data}', function ($doctor_id, $data) {
        $diaSemana = Carbon::parse($data)->dayOfWeek;
        $horariosPossiveis = Schedule::where('doctor_id', $doctor_id)
            ->where('dia_semana', $diaSemana)
            ->pluck('hora');

        $horariosOcupados = Appointment::where('doctor_id', $doctor_id)
            ->where('data', $data)
            ->pluck('hora');

        return $horariosPossiveis->diff($horariosOcupados)->values();
    });
});
