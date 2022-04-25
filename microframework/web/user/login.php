<?php require_once __DIR__ . "/../../vendor/autoload.php"; ?>

<!DOCTYPE html>
<html lang="ca">
<?= My\Helpers::render("/_commons/head.php", ["subtitle" => "Sign in"]) ?>
<body>
    <?= My\Helpers::render("/_commons/header.php") ?>
    <h2>Sign in</h2>
    <p>Welcome back!</p>
    <form name="login" action="<?= My\Helpers::url("/user/actions/login_action.php") ?>" method="post">
        <p>
            <label>Username</label><br>
            <input type="text" name="username" required>
        </p>
        <p>
            <label>Password</label><br>
            <input type="password" name="password" required>
        </p>
        <p>
            <label>
                <input type="checkbox" name="remember">Remember me
            </label>
        </p>
        <p>
            <button>Sign in</button>
            <button type="reset">Reset form</button>
        </p>
    </form>
    <?= My\Helpers::render("/_commons/footer.php") ?>
</body>
</html>