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
        $cnf = include(__DIR__ . "/../config/mail.php");
        $mail = new PHPMailer();

        // Setup SMTP server...
        $mail->IsSMTP();
        $mail->Mailer = $cnf['server']['protocol'];
        $mail->SMTPSecure=$cnf['server']['security'];
        $mail->Host = $cnf['server']['host'];
        $mail->Port =$cnf['server']['port']; 
        $mail->Username = $cnf['server']['username'];
        $mail->Password = $cnf['server']['password'];
        $mail->SMTPDebug = $cnf['server']['debug'];
        $mail->SMTPAuth = true;


        // Configure mail contact: from and reply...
        
        $mail->setFrom($cnf['from']['mail'], $cnf['from']['name']); 
        $mail->addReplyTo($cnf['reply']['mail'], $cnf['reply']['name']);
        // Set subject and body (HTML or not)...
        $mail->Subject = $subject;
        $mail->isHTML(true);
        $mail->Body = $body;

        $this->_mailer = $mail;
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
        foreach($to as $nombre => $correo) {
            $this->_mailer->addAddress($correo, $nombre);
        }
        
        foreach($cc as $nombre => $correo) {
            $this->_mailer->addCC($correo, $nombre);
        }

        foreach($bcc as $nombre => $correo) {
            $this->_mailer->addBCC($correo, $nombre);
        }
        
        // Send mail...
        $enviado = $this->_mailer->send();
        // Clear recipients...
        $this->_mailer ->clearAllRecipients();
        return $enviado;
   }
}
