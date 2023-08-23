<?php

class TaskRepository
{
    private DbContext $dbContext;

    public function __construct(DbContext $dbContext)
    {
        $this->dbContext = $dbContext;
    }

    public function getWeeklyCompletedTasks($username): array
    {
        $sql = "SELECT DAYNAME(completion_date) AS day_name, COUNT(*) AS count
                FROM task_completions
                WHERE user_id IN (SELECT user_id FROM users WHERE username = :username)
                AND completion_date BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()
                GROUP BY DAY(completion_date)";
        $params = array(":username" => $username);
        $result = $this->dbContext->query($sql, $params);

        return $result;
    }

    public function getRecentTasks($username): array
    {
        $sql = "SELECT t.task_id, t.title, t.status, t.due_date, tc.completion_date
                FROM tasks AS t
                LEFT JOIN task_completions AS tc ON t.task_id = tc.task_id
                WHERE t.assigned_to IN (SELECT user_id FROM users WHERE username = :username)
                ORDER BY tc.completion_date IS NOT NULL, t.due_date IS NULL, t.due_date, t.task_id DESC
                LIMIT 5";
        $params = array(":username" => $username);
        $result = $this->dbContext->query($sql, $params);

        return $result;
    }

    public function getActiveTasks($username): array
    {
        $sql = "SELECT
                t.task_id, 
                t.title,
                t.status,
                t.due_date
                FROM tasks AS t
                LEFT JOIN task_completions AS tc ON t.task_id = tc.task_id
                WHERE t.assigned_to IN (SELECT user_id FROM users WHERE username = :username)
                AND tc.completion_date IS NULL
                ORDER BY t.due_date IS NULL, t.due_date ASC;";
        $params = array(":username" => $username);
        $result = $this->dbContext->query($sql, $params);

        return $result;
    }

    public function getCompletedTasks($username): array
    {
        $sql = "SELECT
                t.task_id, 
                t.title,
                t.status,
                t.due_date,
                tc.completion_date
                FROM tasks AS t
                LEFT JOIN task_completions AS tc ON t.task_id = tc.task_id
                WHERE t.assigned_to IN (SELECT user_id FROM users WHERE username = :username)
                AND tc.completion_date IS NOT NULL
                ORDER BY tc.completion_date DESC;";
        $params = array(":username" => $username);
        $result = $this->dbContext->query($sql, $params);

        return $result;
    }

    public function getTask($id)
    {
        $sql = "SELECT
                t.task_id, 
                t.title,
                t.status,
                t.due_date, 
                u.username assigned_to_username,
                u2.username AS created_by_username,
                t.description
                FROM tasks AS t
                LEFT JOIN task_completions AS tc ON t.task_id = tc.task_id
                LEFT JOIN users AS u ON t.assigned_to = u.user_id
                INNER JOIN users AS u2 ON t.created_by = u2.user_id
                WHERE t.task_id = :id;";
        $params = array(":id" => $id);
        $result = $this->dbContext->query($sql, $params);

        if (count($result) > 0) {
            return $result[0];
        } else {
            return null;
        }
    }

    public function checkTaskCompletion($id): bool
    {
        $sql = "SELECT COUNT(*) AS count 
                FROM task_completions 
                WHERE task_id = :id";
        $params = array(":id" => $id);
        $result = $this->dbContext->getScalar($sql, $params);

        return $result;
    }

    public function completeTask($id, $username): void
    {
        $sql = "INSERT INTO task_completions (task_id, user_id, completion_date) 
                VALUES (:id, (SELECT user_id FROM users WHERE username = :username), NOW())";
        $params = array(":id" => $id, ":username" => $username);
        $this->dbContext->execute($sql, $params);

        $sql = "UPDATE tasks SET status = 'Completed' WHERE task_id = :id";
        $params = array(":id" => $id);
        $this->dbContext->execute($sql, $params);
    }

    public function startTask($id): void
    {
        $sql = "UPDATE tasks SET status = 'In Progress' WHERE task_id = :id";
        $params = array(":id" => $id);
        $this->dbContext->execute($sql, $params);
    }

    public function validateTask($id, $username): bool
    {
        $sql = "SELECT COUNT(*) AS count
                FROM tasks 
                WHERE task_id = :id 
                AND assigned_to IN (SELECT user_id FROM users WHERE username = :username)";
        $params = array(":id" => $id, ":username" => $username);
        $result = $this->dbContext->getScalar($sql, $params);

        return $result > 0;
    }

    public function addTask($title, $description, $dueDate): bool
    {
        $sql = "INSERT INTO tasks (title, description, due_date, created_by, assigned_to, status) 
                VALUES (:title, :description, :dueDate, (SELECT user_id FROM users WHERE username = :username), (SELECT user_id FROM users WHERE username = :username), 'To Do')";
        $params = array(":title" => $title, ":description" => $description, ":dueDate" => $dueDate, ":username" => $_SESSION['username']);
        $result = $this->dbContext->execute($sql, $params);

        return $result;
    }

    public function updateTask($taskId, $title, $description, $dueDate, $isCompleted): bool
    {
        $sql = "UPDATE tasks 
                SET title = :title, description = :description, due_date = :dueDate, status = :status 
                WHERE task_id = :taskId";
        $params = array(":taskId" => $taskId, ":title" => $title, ":description" => $description, ":dueDate" => $dueDate, ":status" => $isCompleted ? "Completed" : "To Do");
        $result = $this->dbContext->execute($sql, $params);

        return $result;
    }

    public function deleteTask($taskId): bool
    {
        $sql = "DELETE FROM tasks WHERE task_id = :taskId";
        $params = array(":taskId" => $taskId);
        $result = $this->dbContext->execute($sql, $params);

        return $result;
    }

    public function getTasksByTitle($searchTitle): array
    {
        $sql = "SELECT
                t.task_id, 
                t.title,
                t.status,
                t.due_date,
                u.username assigned_to_username,
                u2.username AS created_by_username
                FROM tasks AS t
                LEFT JOIN task_completions AS tc ON t.task_id = tc.task_id
                LEFT JOIN users AS u ON t.assigned_to = u.user_id
                INNER JOIN users AS u2 ON t.created_by = u2.user_id
                WHERE t.title LIKE :searchTitle
                ORDER BY t.due_date IS NULL, t.due_date ASC;";
        $params = array(":searchTitle" => "%$searchTitle%");
        $result = $this->dbContext->query($sql, $params);

        return $result;
    }
}
