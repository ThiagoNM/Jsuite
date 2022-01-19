<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $content)
    {
        $this->content = $content;
    }
  
    public function build()
    {
        // pass here your email template file
        return $this->markdown('mails.testmail')
            ->with('content', $this->content);
    }
 
}
