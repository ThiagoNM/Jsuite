<?php declare(strict_types=1);
 
use PHPUnit\Framework\TestCase;
use My\Helpers;
 
final class HelpersTest extends TestCase
{
   public function testExpectedText(): void {
       $txt = Helpers::sayHello("Pep");
       $this->assertEquals("Hello Pep", $txt);
   }
}


