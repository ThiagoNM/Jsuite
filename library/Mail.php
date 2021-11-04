<?php
 
namespace My;
use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\Exception as PHPMailerException;
 
class Mail {
   // PHPMailer
   private $_mailer;
 
   /**
    * Constructs mail
    *
    * @param string $subject
    * @param string $body
    * @param bool $isHTML (optional)
    */
   public function __construct(string $subject, string $body, bool $isHTML = false)
   {
       $this->_mailer = new PHPMailer();
       // Setup SMTP server...
       // Configure mail contact: from and reply...
       $mail->setFrom('2daw.equip03@fp.insjoaquimmir.cat', 'Mailer');
       $mail->addAddress('joe@example.net', 'Joe User');     
       $mail->addAddress('ellen@example.com');               
       // Set subject and body (HTML or not)...
 
   }
 
   /**
    * Send mail to recipients
    *
    * @param array $to
    * @param array $cc (optional)
    * @param array $bcc (optional)
    * @return bool
    */
   public function send(array $to, array $cc = [], array $bcc = []) : bool
   {
       // Add recipients (to, cc, bcc)...
       $mail->addReplyTo($to, 'Information');
       $mail->addCC($cc);
       $mail->addBCC($bcc);
       // Send mail...

       // Clear recipients...
   }
}
