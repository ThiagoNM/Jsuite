<?php

require_once __DIR__ . "/../../../vendor/autoload.php";
require_once __DIR__ . "/../../../config/database.php";

use Rakit\Validation\Validator;
use My\User;

if (!empty($_POST)) {

    if (!empty($_POST["email"])) {
        
        if(!My\User::isAuthenticated()){
            $email = $_POST["email"];

            $validator = new Validator;

            $validation = $validator->make($_POST + $_FILES, [
                'email' => 'required|email',
            ]);

            $validation->validate();
            
            if ($validation->fails()) {

                My\Helpers::flash("Correu amb format incorrecte");
                $url = My\Helpers::url("/user/forgot1.php");
                My\Helpers::redirect($url);
                

            }else{
                
                try {
                    $database = new My\Database();
                    
                    $sql = $database -> prepare("SELECT `email`, `id`, `username` FROM `2daw.equip03`.users WHERE email=?");
                    // $sql = bindParam(':email', $_POST['email']);
                    $sql -> execute([$email]);

                    $bool = false;

                    foreach($sql as $fila){
                        if($fila['email']==$email){
                            $id = $fila['id'];
                            $user = $fila['username'];
                            $bool = true;
                        }
                    }
                    
                    if ($bool) {
            
                        $bytes = random_bytes(20);
                        $token = bin2hex($bytes);

                        $dateTime=date('Y-m-d H:i:s');
                        
                        $insertToken = $database->prepare("INSERT INTO `2daw.equip03`.user_tokens VALUES ('{$id}', '{$token}', 'R', '{$dateTime}');");
                        $insertToken->execute();

                        $database->close();
                        
                        $url = My\Helpers::url("/user/forgot2.php");
                        $correo = new My\Mail("Canvi de contrasenya",  'Fes click a <a href="'.$url.'?token='.$token.'">aquest link</a> per canviar la contrasenya.', false);
                    
                        $envio = $correo->send(["2daw.equip03@fp.insjoaquimmir.cat"]);
                        

                    } else {
                        My\Helpers::flash("L'usuari no existeix");
                        $url = My\Helpers::url("/user/forgot1.php");
                        My\Helpers::redirect($url);
                    }

                } catch (PDOException $exception) {
                    My\Helpers::flash("A fallat la connexio a la base de dades");
                    $url = My\Helpers::url("/user/forgot1.php");
                    My\Helpers::redirect($url);
                }
            }

        }else{
            My\Helpers::redirect("../login.php");
            My\Helpers::flash("No pots");
        }

    }else{
        My\Helpers::flash("Correu amb format incorrecte");
        $url = My\Helpers::url("/user/forgot1.php");
        My\Helpers::redirect($url);
        

    }   
}

My\Helpers::flash("Enviat. Revisi el correu.");
$url = My\Helpers::url("/user/forgot1.php");
My\Helpers::redirect($url);
