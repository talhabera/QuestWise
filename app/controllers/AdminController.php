<?php

class AdminController extends Controller
{
    private AdminService $adminService;
    private UserService $userService;
    private TaskService $taskService;
    private AchievementService $achievementService;

    public function __construct(
        UserService $userService,
        AdminService $adminService,
        TaskService $taskService,
        AchievementService $achievementService
    ) {
        parent::__construct($userService, false);

        $this->adminService = $adminService;
        $this->userService = $userService;
        $this->taskService = $taskService;
        $this->achievementService = $achievementService;

        if (!isset($_SESSION['admin_username']) && $_SERVER['REQUEST_URI'] !== '/admin/login') {
            header("Location: /admin/login");
            exit();
        }
    }

    public function indexAction()
    {
        $this->view();
    }

    public function logoutAction()
    {
        unset($_SESSION['admin_username']);
        header("Location: /admin/login");
        exit();
    }

    public function loginAction($error = null)
    {
        if ($_SESSION['admin_username']) {
            header("Location: /admin");
            exit();
        }

        $this->view($error);
    }

    public function loginPostAction()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $result = $this->adminService->login($username, $password);
        if ($result === true) {
            header("Location: /admin");
            exit();
        }

        $this->loginAction($result);
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

        $this->view($model);
    }

    public function userPostAction()
    {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $avatarUrl = $_POST['avatar_url'];

        $this->userService->updateUser($username, $email, $avatarUrl);

        header("Location: /admin/user/talhabera");
        exit();
    }

    public function tasksAction()
    {
        if (isset($_GET["searchTitle"])) {
            $model = new stdClass();
            $model->tasks = $this->taskService->getTasksByTitle($_GET["searchTitle"]);

            $this->view($model);
            return;
        }

        $this->view();
    }

    public function taskAction($id)
    {
        $model = new stdClass();
        $model->task = $this->taskService->getTask($id);
        
        $this->view($model);
    }

    public function taskPostAction()
    {
        $taskId = $_POST['task_id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $dueDate = $_POST['due_date'];

        $this->taskService->updateTask($taskId, $title, $description, $dueDate, false);

        header("Location: /admin/task/$taskId");
        exit();
    }

    public function achievementsAction()
    {
        $this->view();
    }

    public function achievementAction($achievementId)
    {
        $model = new stdClass();
        $model->achievement = $this->achievementService->getAchievement($achievementId);

        $this->view($model);
    }

    public function achievementPostAction()
    {
        $achievementId = $_POST['achievement_id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $points = $_POST['points'];

        $this->achievementService->updateAchievement($achievementId, $title, $description, $points);

        header("Location: /admin/achievement/$achievementId");
        exit();
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

        require_once '../app/views/admin/index.php';
    }
}
