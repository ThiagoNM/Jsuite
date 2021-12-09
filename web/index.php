<?php require_once __DIR__ . "/../vendor/autoload.php"; ?>

<!DOCTYPE html>
<html lang="ca">
    
<?= My\Helpers::render("/_commons/head.php", ["subtitle" => "Pàgina d'inici"]) ?>

<body>

    <?= My\Helpers::render("/_commons/header.php") ?>

    <div class="all">
      <aside class="as1PI">
        <div class="as1PI__cerca">CERCAR</div>
        <div class="as1PI__botonera1">APPS RECENTS</div>
        <div class="as1PI__botonera2">APPS DESTACADES</div>
      </aside>

      <article class="artPI">
        <div class="artPI__apps">APPS</div>
      </article>

      <aside class="as2PI">
        <div class="as2PI__calendari">CALENDARI</div>
        <div class="as2PI__recordatoris">RECORDATORI</div>
      </aside>
    </div>

    <?= My\Helpers::render("/_commons/footer.php") ?>

</body>
</html>