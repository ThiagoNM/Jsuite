<?php

require_once __DIR__ . "/../../../vendor/autoload.php";
require_once __DIR__ . "/../../../config/database.php";

use Rakit\Validation\Validator;


if (!empty($_POST)) {

    if (!empty($_POST["contrasenya"]) && (!empty($_POST["contrasenya2"]))) {

        $pass = $_POST["contrasenya"];
        $pass3 = hash('sha256', $_POST["contrasenya2"]);
        $token = $_POST["token"];
        
        

        $validator = new Validator;

        $validation = $validator->make($_POST + $_FILES, [
            'contrasenya' => 'required|min:8|regex:/\d/',
            'contrasenya2' => 'required|same:contrasenya',
            'token' => 'required',
        ]);

        $validation->validate();
        
        if ($validation->fails()) {

            My\Helpers::flash("Contrasenyes amb format incorrecte");
            $url = My\Helpers::url("/user/forgot2.php");
            My\Helpers::redirect($url);
            

        }else{
            
            $database = new My\Database();

            $sql = $database -> prepare("SELECT `user_id`, `token` FROM `2daw.equip03`.user_tokens WHERE token = ?");
            $sql->execute([$token]);

            $bool = false; 

            foreach($sql as $fila){
                if($fila['token']==$token){
                    $id = $fila['user_id'];
                    $token = $fila['token'];
                    $bool = true;
                }
            }

            if ($bool) {
                
                

                $sql2 = $database -> prepare("UPDATE `2daw.equip03`.users SET password = '{$pass3}' WHERE id = '{$id}'");
                $sql2 -> execute();

                $database->close();
                
                $url = My\Helpers::url("/_commons/html/user/iniciarSessio.html");
                My\Helpers::redirect($url);
               
            }
        }

    }else{
        
        My\Helpers::log()->debug("Redirecció final");

        $url = My\Helpers::url("/user/forgot2.php");
        My\Helpers::redirect($url);
        My\Helpers::flash("Contrasenya canviada");

    }
}