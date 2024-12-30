<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EngineerNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @param array $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */public function build()
    {
        return $this->from('bt@aspilsan.com', 'Kalite Kontrol Mail Servisi')
                    ->markdown('emails.engineer_notification')
                    ->with('data', $this->data)
                    ->subject($this->data['subject'] ?? 'Kalite Kontrol Mail Servisi');
    }
}
