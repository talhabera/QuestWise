<?php

require_once '../config/config.php';
require_once '../app/Router.php';
require_once '../routes/web.php';

require_once '../app/controllers/Controller.php';

$requestPath = $_SERVER['REQUEST_URI'];
$basePath = str_replace('/index.php', '', $_SERVER['PHP_SELF']);

$route = str_replace($basePath, '', $requestPath);

$method = $_SERVER['REQUEST_METHOD'];

Router::dispatch($route, $method);
