<?php

namespace App\Mail;

use AddressInfo;
use App\Models\Despesa;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DespesaCriada extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message
     * 
     * @return $this
     */

     public function build()
     {
        return $this
            ->from('restapi@onfly.com', 'Onfly')
            ->to($this->user->email)
            ->subject('Despesa criada com Sucesso!')
            ->markdown('emails.nova_despesa');
     }
}