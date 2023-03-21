<?php

namespace App\Notifications;

use App\Models\Despesa;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Symfony\Component\Mime\Email;

class DespesaCadastrada extends Notification implements ShouldQueue
{
    use Queueable;
    public $despesa;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Despesa $despesa)
    {
        $this->despesa = $despesa;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        //return['database'];
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting("A Despesa foi Cadastrada com Sucesso!")
                    ->line('Despesa : ' . $this->despesa->descricao)
                    ->line('Valor: ' . $this->despesa->valor)
                    ->line('Data: ' . $this->despesa->data_despesa)
                    ->salutation("Atenciosamente, Onfly.");
    }
}
