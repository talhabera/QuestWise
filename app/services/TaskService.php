<?php

class TaskService
{
    private TaskRepository $taskRepository;

    public function __construct(
        TaskRepository $taskRepository,
    ) {
        $this->taskRepository = $taskRepository;
    }

    public function getCompletedTaskCounts($username): array
    {
        $completedTasks = $this->taskRepository->getCompletedTasks($username);
        // create an array of finished before due date and after due date
        $completedTasksBeforeDueDateCount = 0;
        $completedTasksAfterDueDateCount = 0;
        foreach ($completedTasks as $task) {
            if (!$task['due_date']) {
                $completedTasksBeforeDueDateCount++;
                continue;
            }

            if ($task['completion_date'] <= $task['due_date']) {
                $completedTasksBeforeDueDateCount++;
            } else {
                $completedTasksAfterDueDateCount++;
            }
        }

        return array(
            "beforeDueDate" => $completedTasksBeforeDueDateCount,
            "AfterDueDate" => $completedTasksAfterDueDateCount
        );
    }

    public function getWeeklyCompletedTasks($username): array
    {
        $weeklyCompletedTaskCount = $this->taskRepository->getWeeklyCompletedTasks($username);

        return $weeklyCompletedTaskCount;
    }

    public function getRecentTasks($username): array
    {
        $recentTasks = $this->taskRepository->getRecentTasks($username);

        return $recentTasks;
    }

    public function getActiveTasks($username): array
    {
        $tasks = $this->taskRepository->getActiveTasks($username);
        foreach ($tasks as &$task) {
            if (!$task["due_date"]) {
                continue;
            }
            $date = DateTime::createFromFormat("Y-m-d", $task["due_date"]);
            $formattedDate = $date->format("F d, Y");
            $task["due_date"] = $formattedDate;
        }

        return $tasks;
    }

    public function getCompletedTasks($username): array
    {
        $completedTasks = $this->taskRepository->getCompletedTasks($username);
        foreach ($completedTasks as &$task) {
            if (!$task["completion_date"]) {
                continue;
            }
            $date = DateTime::createFromFormat("Y-m-d H:i:s", $task["completion_date"]);
            $formattedDate = $date->format("F d, Y");
            $task["completion_date"] = $formattedDate;
        }

        return $completedTasks;
    }

    public function getTask($id): array
    {
        $task = $this->taskRepository->getTask($id);

        return $task;
    }

    public function completeTask($id, $userId): string|bool
    {
        $validateTaskResult = $this->taskRepository->validateTask($id, $userId);
        if (!$validateTaskResult) {
            return "Task not found";
        }

        $taskCompletionState = $this->taskRepository->checkTaskCompletion($id);
        if ($taskCompletionState) {
            return "Task already completed";
        }

        $this->taskRepository->completeTask($id, $userId);
        return true;
    }

    public function startTask($id, $userId): string|bool
    {
        $validateTaskResult = $this->taskRepository->validateTask($id, $userId);
        if (!$validateTaskResult) {
            return "Task not found";
        }

        $taskCompletionState = $this->taskRepository->checkTaskCompletion($id);
        if ($taskCompletionState) {
            return "Task completed, start not possible";
        }

        $this->taskRepository->startTask($id);
        return true;
    }

    public function addTask($title, $description, $dueDate): bool
    {
        $result = $this->taskRepository->addTask($title, $description, $dueDate);

        return $result;
    }

    public function updateTask($taskId, $title, $description, $dueDate, $isCompleted): bool
    {
        $result = $this->taskRepository->updateTask($taskId, $title, $description, $dueDate, $isCompleted);

        return $result;
    }

    public function deleteTask($taskId): bool
    {
        $result = $this->taskRepository->deleteTask($taskId);

        return $result;
    }

    public function getTasksByTitle($searchTitle): array
    {
        $tasks = $this->taskRepository->getTasksByTitle($searchTitle);
        foreach ($tasks as &$task) {
            if (!$task["due_date"]) {
                continue;
            }
            $date = DateTime::createFromFormat("Y-m-d", $task["due_date"]);
            $formattedDate = $date->format("F d, Y");
            $task["due_date"] = $formattedDate;
        }

        return $tasks;
    }
}
