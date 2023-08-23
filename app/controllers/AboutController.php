<?php

class AboutController extends Controller
{
    public function __construct(UserService $userService)
    {
        parent::__construct($userService);
    }

    public function indexAction()
    {
        require_once '../app/views/about/index.php';
    }
}
