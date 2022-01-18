<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TestMail extends Mailable
{
	use Queueable, SerializesModels;
	
	public function __construct($content)
	{
		$this->content = $content;
	}

	public function build()
	{
		return $this->markdown('emails.testmail') //pass here your email blade file
	    	->with('content',$this->content);
	}
}