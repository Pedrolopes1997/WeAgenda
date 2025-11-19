<?php

namespace App\Exports;

use App\Models\DemoRequest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DemoRequestsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return DemoRequest::select('nome', 'email', 'telefone', 'hospital', 'created_at')->orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'Nome',
            'Email',
            'Telefone',
            'Hospital/Clínica',
            'Data de Solicitação',
        ];
    }
}
