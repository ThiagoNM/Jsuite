<?php 

use PHPUnit\Framework\TestCase;
use My\Database;

final class DatabaseTest extends TestCase
{
   public function testConnection(): Database
   {
       $db = new Database();
       $this->assertIsObject($db);
       return $db;
   }
 
   /**
    * @depends testConnection
    */
   public function testStatements(Database $db): void
   {
        $db->open();

        $consulta = $db->prepare('SELECT email,role_id FROM users WHERE username = "admin"');
        $consulta->execute();
        $result = $consulta->fetchAll();

        $counter = count($result);
        $this->assertEquals($counter, 1);

        $db->close();
        
        $this->expectException(Exception::class);            
        $consulta = $db->prepare('SELECT email,role_id FROM users WHERE username = "admin"');
        $consulta->execute();
        $result = $consulta->fetchAll();
        
   }  
   

}
?>