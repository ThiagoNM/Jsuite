<header>
<h1><a href="<?= My\Helpers::url("/") ?>">Projecte J-Suite</a></h1>
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
</header>
