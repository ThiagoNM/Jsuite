<header class="capçalera">
     <div class = "container4">
          <img class="capçalera__logo" src="<?= My\Helpers::url("/_commons/fotos/JS6.png")?>"/>
          <img class="capçalera__fotoPerfil" src="<?= My\Helpers::url("/_commons/fotos/exempleperfil.jpg")?>"/>
          <img class="capçalera__tema" src="<?= My\Helpers::url("/_commons/fotos/dark.png")?>"/>
          <img class="capçalera__missatgeria" src="<?= My\Helpers::url("/_commons/fotos/missatge.png")?>"/>
          <h2 class="capçalera__nom">Nom Usuari Lorem</h2>
     </div>
</header>

<?php $flash = My\Helpers::flash(); ?>
<?php if (!empty($flash)): ?>
<div class="flash">
     <ul>
          <?php foreach ($flash as $msg): ?>
          <li class="flash__message"><?= $msg ?></li>
          <?php endforeach; ?>
     </ul>
</div>
<?php endif; ?>


<!--<div class="flash">
<?php if (!empty($flash)): ?>     <ul>
          <?php foreach ($flash as $msg): ?>
          <li class="flash__message"><?= $msg ?></li>
          <?php endforeach; ?>
     </ul>
<?php endif; ?></div>-->