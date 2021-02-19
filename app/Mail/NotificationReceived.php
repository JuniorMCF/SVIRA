<?php

namespace App\Mail;

use App\Models\Cita;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationReceived extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $cita;
    public $cita_datos;

    public function __construct(Cita $cita)
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

        $this->cita_datos = Cita::select('citas.tipo','citas.descripcion','citas.hospital','citas.piso','citas.consultorio','citas.especialidad','citas.fecha_programada','citas.created_at','users.name')
                ->join('users', 'citas.id_doctor', '=', 'users.id')
                ->where('citas.id', $this->cita->id)
                ->first();

        
        return $this->view('mails.notifications');
    }
}
