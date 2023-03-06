<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreateCourseMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var \App\Models\Order
     */
    public $order;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $from = config('obn.mail.from');
        $brand = config('obn.mail.brand');
        $subject = config('obn.mail.subject.create_course');
        return $this->view('mail.auth.mail_create_course')->from( $from , $brand)->subject("[{$brand}] {$subject} ")->with(['data' => $this->data]);
    }
}
