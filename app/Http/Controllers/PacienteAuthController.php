<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PacienteAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('paciente.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('paciente')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/paciente/dashboard');
        }

        return back()->withErrors([
            'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ]);
    }

    public function showRegisterForm()
    {
        return view('paciente.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:pacientes',
            'email' => 'required|email|max:255|unique:pacientes',
            'telefone' => 'nullable|string|max:20',
            'data_nascimento' => 'nullable|date',
            'sexo' => 'nullable|in:M,F,O',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $paciente = Paciente::create([
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'email' => $request->email,
            'telefone' => $request->telefone,
            'data_nascimento' => $request->data_nascimento,
            'sexo' => $request->sexo,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('paciente')->login($paciente);

        return redirect('/paciente/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('paciente')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/paciente/login');
    }
}
