<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/router.php';

App\Classes\App::start(__DIR__);

require_once __DIR__ . '/template_router.php';
App\Classes\Router::start();




