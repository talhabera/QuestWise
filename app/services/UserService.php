<?php
class UserService
{
    private UserRepository $userRepository;
    private TaskService $taskService;
    private AchievementService $achievementService;

    public function __construct(
        UserRepository $userRepository,
        TaskService $taskService,
        AchievementService $achievementService
    ) {
        $this->userRepository = $userRepository;
        $this->taskService = $taskService;
        $this->achievementService = $achievementService;
    }

    public function login($username, $password): bool
    {
        $user = $this->userRepository->getUser($username);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['user_avatar'] = $user["avatar_url"];
            return true;
        }

        return false;
    }

    public function registerUser($username, $email, $password): bool
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $result = $this->userRepository->addUser($username, $email, $hashedPassword);

        return $result;
    }

    public function checkUserExists($username): bool
    {
        $userExists = $this->userRepository->checkUserExists($username);

        return $userExists;
    }

    public function getUserPoints($username): int
    {
        $completedTaskCounts = $this->taskService->getCompletedTaskCounts($username);
        $completedAchievementPoints = $this->achievementService->getAchievementPoints($username);

        $totalPoints = ($completedTaskCounts['beforeDueDate'] * 5)
            + ($completedTaskCounts['afterDueDate'] * 1)
            + $completedAchievementPoints;

        return $totalPoints;
    }

    public function updateSession()
    {
        if (!isset($_SESSION['username'])) {
            header("Location: /questwise/logout");
            exit();
        }

        $totalPoints = $this->getUserPoints($_SESSION['username']);
        $_SESSION['user_point'] = $totalPoints;
    }

    public function getUsers($searchUsername): array
    {
        $users = $this->userRepository->getUsers($searchUsername);

        return $users;
    }

    public function getUser($username)
    {
        $user = $this->userRepository->getUser($username);

        return $user;
    }

    public function updateUser($username, $email, $avatarUrl)
    {
        $this->userRepository->updateUser($username, $email, $avatarUrl);
    }
}
