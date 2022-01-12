<?php

$valor = $_COOKIE['session_token'];

$database = new My\Database();
                
$sql = $database -> prepare("SELECT `user_id`, `token`, `type` FROM user_tokens WHERE token=?");
$sql -> execute([$valor]);
$fila = $sql->fetch();

if($fila['token']==$valor){

    $id = $fila['user_id'];
    $token = $fila['token'];
    $tipus = $fila['type'];

    setcookie('session_token', "", time() - 3600);
    unset($_SESSION['uid']);

    My\Helpers::flash("Sessió expirada");
    $url = My\Helpers::url("/user/index.php");
    My\Helpers::redirect($url);

} else{

    My\Helpers::flash("Sessió expirada");
    $url = My\Helpers::url("/user/index.php");
    My\Helpers::redirect($url);

}