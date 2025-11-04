<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CareerMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->subject('New Career Application')
            ->view('emails.career')
            ->attach($this->data['cv_path'], [
                'as' => 'CV_' . $this->data['name'] . '.' . pathinfo($this->data['cv_path'], PATHINFO_EXTENSION),
                'mime' => mime_content_type($this->data['cv_path']),
            ]);
    }
}
