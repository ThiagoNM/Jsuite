<?php

require_once __DIR__ . "/../../../vendor/autoload.php";

use Rakit\Validation\Validator;


if (!empty($_POST)) {

    if (!empty($_POST["contrasenya"]) && (!empty($_POST["contrasenya2"]))) {

        $pass = $_POST["contrasenya"];
        $pass2 = $_POST["contrasenya2"];
        $token = $_GET["token"];
        

        $validator = new Validator;

        $validation = $validator->make($_POST + $_FILES, [
            'contrasenya' => 'required|min:8|regex:/\d/',
            'contrasenya2' => 'required|same:contrasenya',
        ]);

        $validation->validate();
        
        if ($validation->fails()) {

            My\Helpers::flash("Contrasenyes amb format incorrecte");
            $url = My\Helpers::url("/user/forgot1.php");
            My\Helpers::redirect($url);
            

        }else{
            
            $database = new My\Database();

            $sql = $database -> prepare("SELECT `token` FROM `2daw.equip03`.user_tokens WHERE token = ?");
            $st->execute([$token]);


            foreach($sql as $fila){
                if($fila['token']==$token){
                    $id = $fila['id'];
                    $user = $fila['username'];
                    $bool = true;
                }
            }

            if ($bool) {

                $sql = "UPDATE users SET password = ? WHERE = ";

                $url = My\Helpers::url("/_commons/html/user/iniciarSessio.html");
                My\Helpers::redirect($url);
               
            }
        }

    }else{
        
        My\Helpers::log()->debug("Redirecció final");

        $url = My\Helpers::url("/user/forgot2.php");
        My\Helpers::redirect($url);

    }
}