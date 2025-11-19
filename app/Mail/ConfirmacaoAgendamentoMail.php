<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmacaoAgendamentoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $agendamento;

    public function __construct($agendamento)
    {
        $this->agendamento = $agendamento;
    }

    public function build()
    {
        return $this->subject('Confirmação de Agendamento - WeAgenda')
                    ->view('emails.confirmacao_agendamento');
    }
}
