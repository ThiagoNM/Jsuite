<?php
require_once __DIR__ . "/../../../vendor/autoload.php";  
require_once __DIR__ . '/../../../config/database.php';
use Rakit\Validation\Validator;

if (!empty($_POST)) {
    
  if (!empty($_POST["email"])) {

      $email = $_POST["email"];

      $validator = new Validator;

      $validation = $validator->make($_POST + $_FILES, [
          'email' => 'required|email',
      ]);

      $validation->validate();
      
      if ($validation->fails()) {

          My\Helpers::flash("Correu amb format incorrecte");
          $url = My\Helpers::url("/user/register.php");
          My\Helpers::redirect($url);
          

      }else{

        try {
          $database = new My\Database();
          
          $sql = $database -> prepare("SELECT `email`, `id`, `username` FROM `2daw.equip03`.users WHERE email=?");
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
              $name = $_POST['nom'];
              $email = $_POST['email'];
              $password = $_POST['password'];
              $passwordhash = hash('sha256', $_POST['password']);

              $query = ("INSERT INTO `2daw.equip03`.users (username, password , email, status, role_id, avatar_id, created, last_access)  VALUES ('{$name}', '{$passwordhash}', '{$email}', '0', '2', null, '2020-01-01', '2020-01-01')");
              
              My\Helpers::log()->debug($query);
              $sql = $database -> prepare($query);
              $sql -> execute();
              
              $bytes = random_bytes(20);
              $token = bin2hex($bytes);

              $dateTime=date('Y-m-d H:i:s');
              
              $insertToken = $database->prepare("INSERT INTO `2daw.equip03`.user_tokens VALUES ('{$id}', '{$token}', 'A', '{$dateTime}');");
              $insertToken->execute();

              $database->close();
              
              $url = My\Helpers::url("/user/register_action2.php");
              $correo = new My\Mail("Canvi de contrasenya",  'Fes click a <a href="'.$url.'?token='.$token.'">aquest link</a> per activar el compte.', false);
             
              $envio = $correo->send(["2daw.equip03@fp.insjoaquimmir.cat"]);
              

          } else {
               My\Helpers::flash("L'usuari no existeix");
               $url = My\Helpers::url("/user/register.php");
               My\Helpers::redirect($url);
          }

      } catch (PDOException $exception) {
          My\Helpers::flash("A fallat la connexio a la base de dades");
          $url = My\Helpers::url("/user/register.php");
          My\Helpers::redirect($url);
      }
    }

  }else{
    My\Helpers::flash("Correu amb format incorrecte");
    $url = My\Helpers::url("/user/register.php");
    My\Helpers::redirect($url);
    

  }   
}

My\Helpers::flash("Enviat. Revisi el correu.");
$url = My\Helpers::url("/user/register.php");
My\Helpers::redirect($url);
?>


