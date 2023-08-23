<?php

require_once '../app/repositories/UserRepository.php';
require_once '../app/repositories/TaskRepository.php';
require_once '../app/repositories/AchievementRepository.php';
require_once '../app/repositories/CommentRepository.php';
require_once '../app/repositories/AchievementRepository.php';
require_once '../app/repositories/AdminRepository.php';

require_once '../app/services/UserService.php';
require_once '../app/services/TaskService.php';
require_once '../app/services/AchievementService.php';
require_once '../app/services/CommentService.php';
require_once '../app/services/AchievementService.php';
require_once '../app/services/AdminService.php';

/**
 * Handle the incoming request by dispatching it to the appropriate route.
 *
 * @param Router $router The router instance to handle the request.
 * @return void
 */
function handleRequest(Router $router)
{
    $requestPath = $_SERVER['REQUEST_URI'];
    $basePath = str_replace('/index.php', '', $_SERVER['PHP_SELF']);

    $route = str_replace($basePath, '', $requestPath);
    $route = str_replace('questwise/', '', strtolower($route));
    
    $method = $_SERVER['REQUEST_METHOD'];
    
    $router->dispatch($route, $method);
}

/**
 * Add dependencies to the container.
 *
 * @param Container $container The container instance to add dependencies to.
 * @return void
 */
function addDependencies(Container $container)
{
    addDbContexts($container);
    addRepositories($container);
    addServices($container);
}

function addDbContexts(Container $container){
    $container->bind(DbContext::class, new DbContext());
}

function addRepositories(Container $container)
{
    $container->bind(UserRepository::class);
    $container->bind(TaskRepository::class);
    $container->bind(AchievementRepository::class);
    $container->bind(CommentRepository::class);
    $container->bind(AchievementRepository::class);
    $container->bind(AdminRepository::class);
}

function addServices(Container $container)
{
    $container->bind(UserService::class);
    $container->bind(TaskService::class);
    $container->bind(AchievementService::class);
    $container->bind(CommentService::class);
    $container->bind(AchievementService::class);
    $container->bind(AdminService::class);
}