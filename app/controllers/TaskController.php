<?php
class TaskController extends Controller
{
    private TaskService $taskService;
    private CommentService $commentService;

    public function __construct(
        UserService $userService,
        TaskService $taskService,
        CommentService $commentService
    ) {
        parent::__construct($userService);

        $this->taskService = $taskService;
        $this->commentService = $commentService;
    }

    public function indexAction(int $id)
    {
        $model = new stdClass();
        $model->task = $this->taskService->getTask($id);
        $model->comments = $this->commentService->getTaskComments($id);

        $this->view($model);
    }

    public function tasksAction()
    {
        $model = new stdClass();
        $model->tasks = $this->taskService->getActiveTasks($_SESSION['username']);
        $model->completedTasks = $this->taskService->getCompletedTasks($_SESSION['username']);

        $this->view($model);
    }

    public function complete_taskAction(int $id)
    {
        echo $this->taskService->completeTask($id, $_SESSION['username']);
    }

    public function start_taskAction(int $id)
    {
        echo $this->taskService->startTask($id, $_SESSION['username']);
    }

    public function add_taskAction(){
        $this->view();
    }

    public function add_task_postAction(){
        $taskName = $_POST['title'];
        $taskDescription = $_POST['description'];
        $taskDueDate = $_POST['due_date'];

        echo $this->taskService->addTask($taskName, $taskDescription, $taskDueDate);
        header("Location: /questwise/quests");
    }
}
