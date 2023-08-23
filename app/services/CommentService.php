<?php

class CommentService
{
    private CommentRepository $commentRepository;

    public function __construct(
        CommentRepository $commentRepository,
    ) {
        $this->commentRepository = $commentRepository;
    }

    public function getTaskComments($taskId): array
    {
        $taskComments = $this->commentRepository->getTaskComments($taskId);
        foreach ($taskComments as &$comment) {
            $date = DateTime::createFromFormat("Y-m-d H:i:s", $comment["comment_date"]);
            $formattedDate = $date->format("F d, Y h:i A");
            $comment["comment_date"] = $formattedDate;
        }

        return $taskComments;
    }

    public function addComment($comment, $taskId, $username): bool
    {
        if (strlen($comment) > 250 || strlen($comment) < 1) {
            echo "Comment must be between 1 and 250 characters";
            return false;
        }

        if (time() - $_SESSION["lastComment"] < 10) {
            echo "You must wait 10 seconds between comments";
            return false;
        }

        $this->commentRepository->addComment($comment, $taskId, $username);

        $_SESSION["lastComment"] = time();
        return true;
    }
}
