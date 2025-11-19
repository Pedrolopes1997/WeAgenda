<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Appointment;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (auth()->user()->tipo_usuario === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('hospital.dashboard');
            }
        }

        return back()->withErrors(['email' => 'Credenciais inválidas.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function dashboard()
    {
        // Vamos assumir aqui que o dashboard() é para HOSPITAIS/CLIENTES
        $total = Appointment::count();
        $confirmados = Appointment::where('status', 'confirmado')->count();
        $cancelados = Appointment::where('status', 'cancelado')->count();
        $pendentes = Appointment::where('status', 'agendado')->count();

        // Evolução de Agendamentos últimos 30 dias
        $inicio = Carbon::now()->subDays(29)->startOfDay();
        $fim = Carbon::now()->endOfDay();

        $agendamentosPorDia = Appointment::select(
                DB::raw('DATE(data) as dia'),
                DB::raw('count(*) as total')
            )
            ->whereBetween('data', [$inicio, $fim])
            ->groupBy('dia')
            ->orderBy('dia')
            ->get()
            ->keyBy('dia');

        $dias = [];
        $totais = [];

        for ($i = 0; $i < 30; $i++) {
            $dia = Carbon::now()->subDays(29 - $i)->format('Y-m-d');
            $dias[] = Carbon::parse($dia)->format('d/m');
            $totais[] = isset($agendamentosPorDia[$dia]) ? $agendamentosPorDia[$dia]->total : 0;
        }

        return view('hospital.dashboard', compact('total', 'confirmados', 'cancelados', 'pendentes', 'dias', 'totais'));
    }
}
