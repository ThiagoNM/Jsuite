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
}
