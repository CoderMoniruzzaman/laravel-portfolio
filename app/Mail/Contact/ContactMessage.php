<?php

namespace App\Mail\Contact;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $first_name_to_send ="";
    public $email_to_send ="";
    public $subject_to_send ="";
    public $message_to_send ="";

    public function __construct($name,$email,$subject,$message)
    {
        $this->first_name_to_send = $name;
        $this->email_to_send = $email;
        $this->subject_to_send = $subject;
        $this->message_to_send = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $first_name_to_send = $this->first_name_to_send;
        $email_to_send = $this->email_to_send;
        $subject_to_send = $this->subject_to_send;
        $message_to_send = $this->message_to_send;
        return $this->view('Mail/Contact/contactmessageview',compact('first_name_to_send', 'email_to_send', 'subject_to_send', 'message_to_send'));
    }
}
