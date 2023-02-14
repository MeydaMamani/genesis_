<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EmailFed extends Mailable
{
    use Queueable, SerializesModels;

    public $subcjet = "Información del Contacto";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $anio = '2023'; $mes = '1'; $mes2 = '01';
        $nominal = DB::table('dbo.CONSOLIDADO_PREMATURO')
                    ->where('CORTE_PADRON', $anio.''.$mes2) ->where('PERIODO_MEDICION', $anio.'-'. $mes) ->where('BAJO_PESO_PREMATURO', 'SI')
                    // ->where('SUPLEMENTADO', '=', 'NO')
                    ->orderBy('NOMBRE_PROV', 'ASC') ->orderBy('NOMBRE_DIST', 'ASC') ->orderBy('NOMBRE_EESS', 'ASC')
                    ->get();

        // Mail::to('meydamamani@gmail.com')->send(new EmailFed());
        return $this->view('mail.prematuro', ['nominal' => $nominal]);
    }

    public function index() {
        return view('mail/index');
    }

    public function sendMail()
    {
        Mail::to('meydamamani@gmail.com')->send(new EmailFed());
        return 'Mensaje Enviado!!!';
    }

}
