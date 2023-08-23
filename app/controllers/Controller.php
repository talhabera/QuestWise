<?php

/**
 * Base controller class for handling common functionality.
 */
class Controller
{
    /**
     * Constructor to handle user authentication and session updates.
     *
     * @param UserService $userService The user service instance for session updates.
     * @return void
     */
    protected function __construct(UserService $userService, bool $loginRequired = true)
    {
        if ($loginRequired) {
            if (!isset($_SESSION['username'])) {
                if (!str_starts_with($_SERVER['REQUEST_URI'], '/login')) {
                    header("Location: /login");
                    exit();
                }
            } else {
                $userService->updateSession();
            }
        }
    }

    /**
     * Render a view with an optional model.
     *
     * @param mixed $model The model to pass to the view (optional).
     * @return void
     */
    protected function view($model = null)
    {
        $contentView = $this->getCurrentViewPath();
        if (!file_exists($contentView)) {
            throw new Exception('View not found.'); // Redirect to 500 page
        }

        require_once '../app/views/index.php';
    }

    /**
     * Get the path to the current view based on controller and action.
     *
     * @return string The path to the current view file.
     */
    protected function getCurrentViewPath()
    {
        $controller = str_replace('Controller', '', get_called_class());
        $action = strtolower(str_replace('Action', '', debug_backtrace()[2]['function']));
        return "../app/views/{$controller}/{$action}.php";
    }
}
