<?php

namespace App\Mail;

use App\Models\Cita;
use App\Models\Teleconsulta;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationTeleconsulta extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $cita;
    public $cita_datos;

    public function __construct(Teleconsulta $cita)
    {
        $this->cita = $cita;        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $this->cita_datos = Teleconsulta::select('teleconsultas.tipo','teleconsultas.especialidad','teleconsultas.fecha_programada','teleconsultas.created_at','teleconsultas.link_google','users.name')
                ->join('users', 'teleconsultas.id_doctor', '=', 'users.id')
                ->where('teleconsultas.id', $this->cita->id)
                ->first();

        
        return $this->view('mails.teleconsultanoti');
    }
}