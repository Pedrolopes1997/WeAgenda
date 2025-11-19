<?php

namespace App\Mail;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConsultaReagendadaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $agendamento;

    public function __construct(Appointment $agendamento)
    {
        $this->agendamento = $agendamento;
    }

    public function build()
    {
        return $this->subject('Confirmação de Reagendamento - WeAgenda')
                    ->view('emails.consulta-reagendada');
    }
}
