<?php

    /* Comprovem si hi ha una sessiò existent */
    if (isset($_COOKIE["session_token"])) {

        /* Guardem en una variable el session_token */
        $token_sessio = $_COOKIE["session_token"];

        /* Eliminem el user_token de la base de dades */
        $database = new My\Database();
        $insertToken = $database->prepare("DELETE FROM `user_tokens` WHERE `user_id` = '$token_sessio';");
        $insertToken->execute();

        $database->close();

        /* Eliminem la cookie */
        setcookie($token_sessio, "", time());

        /* Eliminem la variable de sessiò */
        session_start();
        unset($_SESSION["uid"]);

        /* Mostrem un missatge i redirigim a la pàgina d'inici */
        My\Helpers::flash("Vosté ha sortit.");
        $url = My\Helpers::url("/index.php");
        My\Helpers::redirect($url);

    }
    else{

        /* No es trova el token de sessiò */
        My\Helpers::flash("No s'ha trobat una sessiò activa.");
        $url = My\Helpers::url("/index.php");
        My\Helpers::redirect($url);

    }

?>