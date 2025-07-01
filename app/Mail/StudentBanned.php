<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Content;

use Illuminate\Queue\SerializesModels;

class StudentBanned extends Mailable
{
    use Queueable, SerializesModels;

    public $student;

    public function __construct($student)
    {
        $this->student = $student;
    }

    public function build()
    {
        return $this->subject('Account Banned Notification')
                    ->view('ban-email')
                    ->with([
                        'name' => $this->student->name,
                    ]);
    }
    
}
