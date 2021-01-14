<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\EnvioBoleta;
use QrCode;
use Mail;
use PDF;

class EnviarBoletaJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $boleta;
    protected $numeros;
    protected $usuario;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($numeros, $boleta, $usuario)
    {
        $this->boleta = $boleta;
        $this->numeros = $numeros;
        $this->usuario = $usuario;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $boleta = $this->boleta;
        $numeros = $this->numeros;
        $usuario = $this->usuario;
        //pdf
        $direccion = asset('comprobar/boleta')."/".Crypt::encrypt($boleta->idBoleta);
        $qr = QrCode::format('png')->size(300)->generate($direccion);
        $pdf = PDF::loadView('admin.boletas.pdf',compact('boleta','numeros','qr','usuario'));
        Mail::to($usuario->correoUsuario)->bcc(['pauloberrios@gmail.com','tickets@rifomipropiedad.com','lina.di@isbast.com','ivan.saez@informatica.isbast.com'])->send(new EnvioBoleta($boleta, $numeros, $pdf, $usuario));
    }
}
