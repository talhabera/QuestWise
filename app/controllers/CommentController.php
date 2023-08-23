<?php

class CommentController extends Controller
{
    private CommentService $commentService;

    public function __construct(
        UserService $userService,
        CommentService $commentService
    ) {
        parent::__construct($userService);

        $this->commentService = $commentService;
    }

    public function send_commentAction()
    {
        $comment = $_POST['comment'];
        $taskId = $_POST['taskId'];

        echo $this->commentService->addComment($comment, $taskId, $_SESSION['username']);
    }
}
