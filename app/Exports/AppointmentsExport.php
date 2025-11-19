<?php

namespace App\Exports;

use App\Models\Appointment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;

class AppointmentsExport implements FromCollection, WithHeadings
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Appointment::with(['doctor.specialty']);

        if ($this->request->filled('doctor_id')) {
            $query->where('doctor_id', $this->request->doctor_id);
        }

        if ($this->request->filled('specialty_id')) {
            $query->whereHas('doctor', function($q) {
                $q->where('specialty_id', $this->request->specialty_id);
            });
        }

        if ($this->request->filled('status')) {
            $query->where('status', $this->request->status);
        }

        if ($this->request->filled('data_inicio')) {
            $query->whereDate('data', '>=', $this->request->data_inicio);
        }

        if ($this->request->filled('data_fim')) {
            $query->whereDate('data', '<=', $this->request->data_fim);
        }

        return $query->get()->map(function ($appointment) {
            return [
                'Paciente' => $appointment->nome_paciente,
                'Médico' => $appointment->doctor->nome,
                'Especialidade' => $appointment->doctor->specialty->nome,
                'Data' => \Carbon\Carbon::parse($appointment->data)->format('d/m/Y'),
                'Hora' => substr($appointment->hora,0,5),
                'Status' => ucfirst($appointment->status),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Paciente',
            'Médico',
            'Especialidade',
            'Data',
            'Hora',
            'Status',
        ];
    }
}