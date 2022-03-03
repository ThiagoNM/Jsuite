<?php require_once __DIR__ . "/../../vendor/autoload.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regsitrar-se</title>
    <link rel="stylesheet" href="css/user.register.css">
</head>
<body>

<div class="formulari">
    <div class="formulari__panell"> 
        <!-- <img src="img/JS6.png" class="logo"> -->
        <div class="formulari__capcalera">
            <h1>Registrar-se</h1>
        </div>
        <div class="formulari__contingut">
            <form action="actions/register_action1.php" method="post">
                <!-- <div class="formulari__grup"><label for="username"><img class="foto__perfil" src="img/external-content.duckduckgo.com.png"></label></div> -->
                <div class="formulari__grup"><label for="username">Usuari</label><input type="text" id="nom" name="nom" required="required" /></div>
                <div class="formulari__grup"><label for="password">Correu electronic</label><input type="text" id="email" name="email" required="required" /></div>
                <div class="formulari__grup"><label for="password">Contrasenya</label><input type="password" id="contrasenya" name="password" required="required" /></div><br>
                <div class="formulari__grup"><button type="submit">Crear compte</button></div>
                <div class="formulari__grup"><input type="hidden" value="<?= $_GET['token']?>"></div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
