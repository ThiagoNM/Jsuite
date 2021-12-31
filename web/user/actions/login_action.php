<?php

require_once __DIR__ . "/../../../vendor/autoload.php";
require_once __DIR__ . '/../../../config/database.php';

use Rakit\Validation\Validator;
use My\Helpers;
use My\Database;
use My\User;


$url = Helpers::url("/"); // Go to homepage
session_start();
$validator = new Validator();

$validation = $validator->make($_POST, [
    'username' => 'required',
    'password' => 'required'
]);


$validation->validate();

if ($validation->fails()) {
    // See https://github.com/rakit/validation#working-with-error-message
    $errors = $validation->errors();
    $messages = $errors->all();
    foreach ($messages as $message) {
        Helpers::flash($message);
    }

} else {
    if(My\User::isAuthenticated()){
        
        My\Helpers::flash();

        $username = $_POST["username"];
        $password = hash("sha256", $_POST["password"]);
        
        try {
            Helpers::log()->debug("Check username and password");
            $db = new Database();
            $sql = "SELECT * FROM users u WHERE u.username='$username' AND password='$password'";
            Helpers::log()->debug("SQL: {$sql}");
            $stmt = $db->prepare($sql);
            $stmt->execute();
            
            if ($user = $stmt->fetch()) {
                Helpers::log()->debug("Username and password OK");

                $datetime = date('Y-m-d H:i:s');
                $uid = $user["id"];
                
                // Update user
                Helpers::log()->debug("Update user last access");
                $sql = "UPDATE users 
                        SET last_access='$datetime' 
                        WHERE id=$uid";
                Helpers::log()->debug("SQL: {$sql}");
                $stmt = $db->prepare($sql);
                $stmt->execute();
                Helpers::log()->debug("User updated");

                // Create user session token
                
                $bytes = random_bytes(20);
                $token = bin2hex($bytes);

                $dateTime=date('Y-m-d H:i:s');
                
                $insertToken = $db->prepare("INSERT INTO `2daw.equip03`.user_tokens VALUES ('{$uid}', '{$token}', 'S', '{$dateTime}');");
                $insertToken->execute();
                
                $db->close();
                // ..

                //Create user session cookie
                if (isset($_POST['extender'])){
                    setcookie("session_token",$token,strtotime('1+ month'));
                } else {
                    setcookie("session_token",$token,time()+3600);
                }
                
                Helpers::flash("Bienvenido");
                $_SESSION['uid']=$uid;

                Helpers::log()->debug($_COOKIE['session_token']);
                
                Helpers::redirect($url);
                Helpers::redirect($url);
                My\Helpers::flash("<a href='../profile.php'>Profile</a>");
                My\Helpers::flash("<a href='../logout.php'>Logout</a>");
                // ...
                
            } else {
                Helpers::log()->debug("Invalid username and password");
                Helpers::flash("Error de credencials. Prova de nou");
            }
        } catch (PDOException $e) {
            Helpers::log()->debug($e->getMessage());
            Helpers::flash("No s'han pogut enviar les dades. Prova-ho més tard.");
        } catch (Exception $e) {
            Helpers::log()->debug($e->getMessage());
            Helpers::flash("Hi hagut un error inesperat. Prova-ho més tard.");
        }
    }else{
        My\Helpers::redirect("../login.php");
        My\Helpers::flash("No existeix");
    }
}
Helpers::redirect("/");
My\Helpers::flash("<a href='../login.php'>Login</a>");
My\Helpers::flash("<a href='../register.php'>Register</a>");
