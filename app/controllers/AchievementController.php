<?php

class AchievementController extends Controller
{
    private AchievementService $achievementService;

    public function __construct(
        UserService $userService,
        AchievementService $achievementService
    ) {
        parent::__construct($userService);

        $this->achievementService = $achievementService;
    }

    public function indexAction()
    {
        $model = new stdClass();
        $model->achievements = $this->achievementService->getAchievements($_SESSION['username']);
        $model->otherAchievements = $this->achievementService->getOtherAchievements($_SESSION['username']);

        $this->view($model);
    }
}
