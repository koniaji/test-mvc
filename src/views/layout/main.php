<?php
/* @var $content string */

use App\core\Application;

$user = Application::$container->get('user');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test</title>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/bootstrap/bootstrap.css?>">
</head>
<body>
<nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="/">
        Site
    </a>
    <?php if ($user->getId()): ?>
        <a class="navbar-brand" href="/auth/logout">
            Logout
        </a>
    <?php else: ?>
        <a class="navbar-brand" href="/auth/login">
            Login
        </a>
    <?php endif; ?>
</nav>
<?= $content ?>
</body>
</html>
