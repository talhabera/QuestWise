<?php
session_start();

require_once '../config/config.php';

require_once '../main/main.php';
require_once '../main/DbContext.php';
require_once '../main/Container.php';
require_once '../main/Router.php';

require_once '../app/controllers/Controller.php';
require_once '../routes/web.php';

/**
 * Create a new container instance and add dependencies.
 */
$container = new Container();
addDependencies($container);

/**
 * Create a new router instance and initialize routes.
 */
$router = new Router($container);
initializeRoutes($router);

/**
 * Handle the incoming request using the router.
 */
handleRequest($router);