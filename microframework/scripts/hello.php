<?php
 
// Load composer dependencies
require_once __DIR__ . "/../vendor/autoload.php";
 
$username = get_current_user();
echo My\Helpers::sayHello($username) . PHP_EOL;
