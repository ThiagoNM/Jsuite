<?php declare(strict_types=1);
 
use PHPUnit\Framework\TestCase;
use My\Helpers;
 
final class HelpersTest extends TestCase
{
   public function testExpectedText(): void 
   {
       $txt = Helpers::sayHello("Pep");
       $this->assertEquals("Hello Pep", $txt);
    }
    public function testurl(): void
    {
        $path = "/user/login";
        $txt = Helpers::url($path);
        $this ->assertStringStartsWith("http://", $txt);
        $this ->assertStringEndsWith($path, $txt);
        $txt = Helpers::url($path, true);
        $this ->assertStringStartsWith("https://", $txt);
        $this ->assertStringEndsWith($path, $txt);
    }
}

/* final class StringStartsWithTest extends TestCase
{
    public function testFailure(): void
    {
        if ($ssl == False){
            $this->assertStringStartsWith('prefix', "http://localhost/tarda/projecto/web/{$path}");
        } 
        else{
            $this->assertStringStartsWith('prefix', "https://localhost/tarda/projecto/web/{$path}");
        }
    }
} */
