<?php

class UserController extends Controller
{
    private UserService $userService;
    private TaskService $taskService;

    public function __construct(
        UserService $userService,
        TaskService $taskService
    ) {
        parent::__construct($userService);

        $this->userService = $userService;
        $this->taskService = $taskService;
    }

    public function usersAction()
    {
        if (isset($_GET["searchUsername"])) {
            $model = new stdClass();
            $model->users = $this->userService->getUsers($_GET["searchUsername"]);

            $this->view($model);
            return;
        }

        $this->view();
    }

    public function userAction($username)
    {
        $model = new stdClass();
        $model->user = $this->userService->getUser($username);
        $model->userPoints = $this->userService->getUserPoints($username);

        $totalCompletedTasks = $this->taskService->getCompletedTaskCounts($username);
        $model->totalCompletedTasks = $totalCompletedTasks['beforeDueDate'] + $totalCompletedTasks['afterDueDate'];

        $model->weeklyCompletedTasks = $this->taskService->getWeeklyCompletedTasks($username);

        $this->view($model);
    }
}
