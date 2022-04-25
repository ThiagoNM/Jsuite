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
            <form name="create2" method="post" action="actions/forgot2_action.php">
                <div class="formulari__grup"><label for="contrasenya">Nova contrasenya</label><input type="text" id="contrasenya" name="contrasenya"/></div>
                <div class="formulari__grup"><label for="contrasenya2">Repeteix la contrasenya</label><input type="text" id="contrasenya2" name="contrasenya2"/></div><br>
                <div class="formulari__grup"><button type="submit">Desar</button></div>
                <input type = "hidden" name = "token" value = "<?= $_GET['token']?>">
            </form>
        </div>
    </div>
</div>
</body>
</html>