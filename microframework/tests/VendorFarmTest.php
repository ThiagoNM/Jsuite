<?php declare(strict_types=1);
 
use PHPUnit\Framework\TestCase;
use Cowsayphp\Cow;
use Cowsayphp\Farm;
 
final class VendorFarmTest extends TestCase
{
   public function testCow(): void {       
       $txt = Cow::say("I'm a cow!");
       $this->assertNotEmpty($txt);
   }
  
   public function testTux(): void {
       $obj = Farm::create(Farm\Tux::class);
       $msg = "I'm Tux!";
       $txt = $obj->say($msg);
       $this->assertStringContainsString($msg, $txt);
   }
}

