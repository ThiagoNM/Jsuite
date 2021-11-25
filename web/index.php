<?php require_once __DIR__ . "/../vendor/autoload.php"; ?>

<!DOCTYPE html>
<html lang="ca">
    
<?= My\Helpers::render("/_commons/head.php", ["subtitle" => "Pàgina d'inici"]) ?>

<body class = "container">

    <?= My\Helpers::render("/_commons/header.php") ?>

    <aside class="as1PI">

    <div class = "container2">
        <div class="as1PI__calendari">CALENDARI</div>
        <div class="as1PI__recordatoris">RECORDATORIS</div>
      </div>

    </aside>

    <article class="artPI">APLICACIONS</article>

    <aside class="as2PI">
      <div class = "container3">
        <div class="as2PI__cerca">BUSCAR</div>
        <div class="as2PI__filtrar">FILTRAR</div>
      </div>
    </aside>

    <?= My\Helpers::render("/_commons/footer.php") ?>

</body>
</html>

<!-- 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
