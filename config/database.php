<?php
 
return [
   "driver"    => "mysql",
   "host"      => "alumnes.insjoaquimmir.cat",
   "port"      => 9316,
   "database"  => "2daw.equip03",
   "user"      => "2daw.equip03",
   "password"  => "L8Ry4=<U",
   "options"   => [
       PDO::MYSQL_ATTR_SSL_KEY                => __DIR__ . '/client-key.pem',
       PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false
   ]
];


try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $user, $password);

} catch (PDOException $exception) {
    echo "A fallat la conexion a la base: {$exception->getMessage()}";
}