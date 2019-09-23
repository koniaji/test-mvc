<?php
require __DIR__ . '/../vendor/autoload.php';

define('APP_DIR', __DIR__ . '/..');
define('WEB_DIR', __DIR__);

$config = require __DIR__ . '/../config/web.php';

(new \App\core\Application($config))->run();

