<?php
 
return [
   "driver"    => "mysql",
   "host"      => "alumnes.insjoaquimmir.cat",
   "port"      => 9316,
   "database"  => "demo",
   "user"      => "demo",
   "password"  => "VGz739ghGmQU",
   "options"   => [
       PDO::MYSQL_ATTR_SSL_KEY                => __DIR__ . '/client-key.pem',
       PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false
   ]
];
?>