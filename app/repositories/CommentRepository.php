<?php

class CommentRepository
{
    private DbContext $dbContext;

    public function __construct(DbContext $dbContext)
    {
        $this->dbContext = $dbContext;
    }

    public function getTaskComments($taskId): array
    {
        $sql = "SELECT c.comment_text, c.comment_date, u.username, u.avatar_url
                FROM comments AS c
                INNER JOIN users AS u ON c.user_id = u.user_id
                WHERE c.task_id = :taskId
                ORDER BY c.comment_date DESC";
        $params = array(":taskId" => $taskId);
        $result = $this->dbContext->query($sql, $params);

        return $result;
    }

    public function addComment($comment, $taskId, $username): void
    {
        $sql = "INSERT INTO comments (comment_text, task_id, user_id) VALUES (:comment, :taskId, (SELECT user_id FROM users WHERE username = :username))";
        $params = array(":comment" => $comment, ":taskId" => $taskId, ":username" => $username);
        $this->dbContext->execute($sql, $params);
    }
}
