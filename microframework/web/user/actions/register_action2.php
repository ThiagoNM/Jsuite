<?php
$database = new My\Database();

    
    $sql = $database -> prepare("SELECT `token`, `id`FROM `2daw.equip03`.users WHERE token=?");
    $sql -> execute([$token]);

    foreach($sql as $fila){
        if($fila['email']==$email){
            $id = $fila['id'];
            $user = $fila['username'];
            $bool = true;
        }
    }