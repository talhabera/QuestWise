<?php

class HomeController extends Controller
{
    private TaskService $taskService;

    public function __construct(
        UserService $userService,
        TaskService $taskService
    ) {
        parent::__construct($userService);

        $this->taskService = $taskService;
    }

    public function indexAction()
    {
        $this->view();
    }

    public function weeklyTaskAction()
    {
        echo json_encode($this->taskService->getWeeklyCompletedTasks($_SESSION['username']));
    }

    public function tasksAction()
    {
        echo json_encode($this->taskService->getRecentTasks($_SESSION['username']));
    }
}
