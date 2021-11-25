<?php require_once __DIR__ . "/../../vendor/autoload.php"; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canviar Contrasenya</title>
    <link rel="stylesheet" href="css/user.forgot.css">
</head>

    
<body>

<?= My\Helpers::render("/_commons/header.php")?>


<div class="formulari">
    <div class="formulari__panell">
        <img src="fotos/JS6.png" class="logo">
        <div class="formulari__capcalera">
            <h1>Canviar Contrasenya</h1>
        </div>
        <div class="formulari__contingut">

            <form name="create1" method="post" action="actions/forgot1_action.php">
                <div class="formulari__grup"><label for="text">Introdueix el teu correu</label><input type="text" id="email" name="email"/></div>
                <div class="formulari__grup"><button type="submit">Desar</button></div>
            </form>
        </div>
    </div>
</div>



</body>
</html>