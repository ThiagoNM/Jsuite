<?php 
require_once __DIR__ . "/../../vendor/autoload.php";

$database = new My\Database();
$sql = $database -> prepare("SELECT `id`, `username`, `email` FROM users WHERE id=1");
$sql -> execute();
$user = $sql->fetch();

?>

<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projecte J-Suite / <?= $__params["subtitle"] ?? "" ?></title>
    <link rel="stylesheet" href="<?= My\Helpers::url("/_commons/css/reset.css")?>">
    <link rel="stylesheet" href="<?= My\Helpers::url("/user/css/user.profile.css")?>">
</head>

<body>
    
    <?= My\Helpers::render("/_commons/header.php") ?>

    <div class="formulari">
        <div class="formulari__panell">
            <div class="formulari__capcalera">
                <h1>Editar perfil</h1>
            </div>
            <div class="formulari__contingut">
                <form name="profile" action="./actions/profile_action.php" method="POST">
                    <input type="hidden" id="id"  value="<?= $user["id"]; ?>" />
                    <div class="formulari__grup"><img class="foto__perfil" src="../_commons/fotos/external-content.duckduckgo.com.png"></div>
                    <div class="formulari__grup"><label for="username">Usuari</label><input disabled="disabled" type="text" id="nom" name="nom" value="<?= $user["username"]; ?>" disabled/></div>
                    <div class="formulari__grup"><label for="email">Correu electrÃ²nic</label><input type="email" id="email" name="email" value="<?= $user["email"]; ?>"/></div>
                    <div class="formulari__grup"><label for="password">Contrasenya</label><input type="password" id="contrasenya" name="contrasenya" required="required"/></div>
                    <div class="formulari__grup"><label for="password">Repeteix contrasenya</label><input type="password" id="contrasenya2" name="contrasenya2" required="required" /></div><br>
                    <div class="formulari__grup"><button type="submit">Editar</button></div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>