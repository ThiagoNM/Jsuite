<?php
namespace My;
 
class Helpers {
   /**
    * Says hello to user
    *
    * @return string
    */
   public static function sayHello($username) {
       return "Hello {$username}";
   }
   public static function url(string $path, bool $ssl = false): string 
   {
      $protocol = $ssl ? "https" : "http";
      return "{$protocol}://localhost/tarda/projecto/web/{$path}";
   }
}
