<!DOCTYPE html>
<html lang="ca">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Projecte J-Suite</title>
</head>
<body>
   <header>
       <h1><a href="<?= $_SERVER['HTTP_REFERER'] ?>">Projecte J-Suite</a></h1>
   </header>
   <h2>Homepage</h2>
   <p>My first PHP web app works!</p>
   <ul>
       <li>Operative system: <?= PHP_OS ?></li>
       <li>Web server: <?= $_SERVER['SERVER_SOFTWARE'] ?></li>
       <li>PHP version: <?= phpversion() ?></li>
       <li>IP address: <?= getHostByName(getHostName()) ?></li>
   </ul>
   <footer>
       <p>Curs 2021-22 de 2DAW</p>
   </footer>
</body>
</html>

<!-- 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