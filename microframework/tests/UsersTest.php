<?php declare(strict_types=1);
 
use PHPUnit\Framework\TestCase;
use My\User;
 
final class UserTest extends TestCase
{
   public function testUsuaris(): void
   {
        
        $user = User::isAuthenticated();
        $this->assertFalse($user);

   }
}
