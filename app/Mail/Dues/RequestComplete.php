<?php

namespace App\Mail\Dues;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestComplete extends Mailable
{
    use Queueable, SerializesModels;

    public $uid;
    public $duesPackage;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($uid, $duesPackage)
    {
        $this->uid = $uid;
        $this->duesPackage = $duesPackage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@my.robojackets.org', 'RoboJackets')
                    ->withSwiftMessage(function ($message) {
                        $message->getHeaders()
                            ->addTextHeader('Reply-To', 'RoboJackets <treasurer@robojackets.org>');
                    })
                    ->subject('[RoboJackets] ACTION REQUIRED | Dues Form Received')
                    ->markdown('mail.dues.requestcomplete');
    }
}
