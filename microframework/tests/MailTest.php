<?php declare(strict_types=1);
 
use PHPUnit\Framework\TestCase;
use My\Mail;
 
final class MailTest extends TestCase
{
   public function testConstructor(): Mail
   {
       $mail = new Mail("Title", "Body");
       $this->assertIsObject($mail);
       return $mail;
   }
 
   /**
    * @depends testConstructor
    */
   public function testSend(Mail $mail): void
   {
       $result = $mail->send(
              ["Pep" => "pep.jimenez@insjoaquimmir.cat"],     // TO
              ["Joan" => "jomome@fp.insjoaquimmir.cat"]  // CC
       );
       $this->assertTrue($result);
   }
}

