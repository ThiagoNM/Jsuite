<?php

return [
    "driver"    => "mysql",
    "host"      => "alumnes.insjoaquimmir.cat",
    "port"      => 9316,
    "database"  => "2daw.equip03",
    "user"      => "2daw.equip03",
    "password"  => "L8Ry4=<U",
    "options"   => [
        PDO::MYSQL_ATTR_SSL_KEY                => __DIR__ . '/client-ssl/client-key.pem',
        PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false
        //PDO::MYSQL_ATTR_SSL_CERT => __DIR__ . '/client-ssl/client-cert.pem',
        //PDO::MYSQL_ATTR_SSL_CA   => __DIR__ . '/client-ssl/ca-cert.pem'
    ]
];