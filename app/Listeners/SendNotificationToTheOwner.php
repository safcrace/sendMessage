<?php

namespace App\Listeners;

use App\Events\MessageWasReceived;
use Illuminate\Support\Facades\Mail;

class SendNotificationToTheOwner
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MessageWasReceived  $event
     * @return void
     */
    public function handle(MessageWasReceived $event)
    {
        $message = $event->message;
        /** Envio de Correo de notificacion */
        Mail::send('emails.contact', ['msg' => $message], function ($ms) use ($message) {
            $ms->from($message->email)
               ->to('yeimy@gmail.com', 'Yeimy Gonzalez')
               ->subject('Tu mensaje fue recibido');
        });
    }
}
