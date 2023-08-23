<?php
require_once '../app/controllers/HomeController.php';
require_once '../app/controllers/LoginController.php';
require_once '../app/controllers/TaskController.php';
require_once '../app/controllers/CommentController.php';
require_once '../app/controllers/AchievementController.php';
require_once '../app/controllers/UserController.php';
require_once '../app/controllers/AdminController.php';

// Example of registering a route
// method('route', 'ControllerName@ActionName');

// Home page
function initializeRoutes(Router $router){
    $router->get('/', HomeController::class, 'index');
    $router->get('/home/weekly-quest', HomeController::class, 'weekly_task');
    $router->get('/home/quests', HomeController::class, 'tasks');


    $router->get('/login', LoginController::class, 'index');
    $router->get('/logout', LoginController::class, 'logout');
    
    $router->post('/login', LoginController::class, 'login');
    $router->post('/register', LoginController::class, 'register');


    $router->get('/quest/{id}', TaskController::class, 'index');
    $router->get('/add-quest', TaskController::class, 'add_task');
    $router->get('/quests', TaskController::class, 'tasks');
    $router->get('/complete-quest/{id}', TaskController::class, 'complete_task');
    $router->get('/start-quest/{id}', TaskController::class, 'start_task');

    $router->post('/add-quest', TaskController::class, 'add_task_post');


    $router->post('/send-comment', CommentController::class, 'send_comment');


    $router->get('/achievements', AchievementController::class, 'index');


    $router->get('/users', UserController::class, 'users');
    $router->get('/user/{username}', UserController::class, 'user');

    $router->get('/admin', AdminController::class, 'index');
    $router->get('/admin/login', AdminController::class, 'login');
    $router->get('/admin/logout', AdminController::class, 'logout');
    $router->get('/admin/users', AdminController::class, 'users');
    $router->get('/admin/user/{username}', AdminController::class, 'user');
    $router->get('/admin/quests', AdminController::class, 'tasks');
    $router->get('/admin/quest/{id}', AdminController::class, 'task');
    $router->get('/admin/achievements', AdminController::class, 'achievements');
    $router->get('/admin/achievement/{id}', AdminController::class, 'achievement');

    $router->post('/admin/login', AdminController::class, 'login_post');
    $router->post('/admin/user', AdminController::class, 'user_post');
    $router->post('/admin/quest', AdminController::class, 'task_post');
    $router->post('/admin/achievement', AdminController::class, 'achievement_post');
}
