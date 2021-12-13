<?php

require_once __DIR__ . "/../../../vendor/autoload.php";
require_once __DIR__ . "/../../../config/database.php";

use Rakit\Validation\Validator;

if (!empty($_POST)) {
    
    $validation = $validator->validate($_POST + $_FILES, [
    //    'nom'                   => 'required|min:6',
        'contrasenya'           => 'required|min:8|regex: /\d/',
        'contrasenya2'          => 'required|same:contrasenya',
    //    'avatar'                => 'uploaded_file:0,1000K,png,jpg,gif',
    ]);

    if ($validation->fails()) {

        My\Helpers::flash("Dades incorrectes");
        $url = My\Helpers::url("/user/profile.php");
        My\Helpers::redirect($url);
    
    }

    else if (!empty($_POST["email"])) {

        $email = $_POST["email"];
        $validator = new Validator;
        $validation = $validator->make($_POST + $_FILES, [
            'email' => 'required|email',
        ]);
        $validation->validate();
        
        if ($validation->fails()) {

            My\Helpers::flash("Adreça electronica invalida.");
            $url = My\Helpers::url("/user/profile.php");
            My\Helpers::redirect($url);

        }else{
            
            try {

                $database = new My\Database();
                $sql = $database -> prepare("SELECT `email`, `id`, `username` FROM `2daw.equip03`.users WHERE email=?");
                // $sql = bindParam(':email', $_POST['email']);
                $sql -> execute([$email]);
                $bool = false;

                foreach($sql as $line){
                    if($line['email']==$email){
                        $id = $line['id'];
                        $user = $line['username'];
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
                    
                    $url = My\Helpers::url("/user/profile.php");
                    $correo = new My\Mail("Canvi de email",  'Per confirmar el canvi de compte fes click a <a href="'.$url.'?token='.$token.'">aquest link</a>.', false);
                   
                    $envio = $correo->send(["2daw.equip03@fp.insjoaquimmir.cat"]);
                    

                } else {
                    My\Helpers::flash("L'usuari no existeix");
                    $url = My\Helpers::url("/user/profile.php");
                    My\Helpers::redirect($url);
                }

            } catch (PDOException $exception) {
                My\Helpers::flash("A fallat la connexio a la base de dades");
                $url = My\Helpers::url("/user/profile.php");
                My\Helpers::redirect($url);
            }
        }

    }else{
        My\Helpers::flash("Correu amb format incorrecte");
        $url = My\Helpers::url("/user/profile.php");
        My\Helpers::redirect($url);
        

    }   
}

My\Helpers::flash("S'ha desactivat el compte temporalment, hem enviat un correu d'activació a l'adreça electronica introduïda.");
$url = My\Helpers::url("/user/profile.php"); //REDIRIGEIX A LA PÀGINA D'INICI
My\Helpers::redirect($url);
