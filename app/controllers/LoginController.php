<?php

class LoginController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        parent::__construct($userService);

        $this->userService = $userService;

        if (isset($_SESSION['username']) && $_SERVER['REQUEST_URI'] !== '/logout') {
            header("Location: /");
            exit();
        }
    }

    public function indexAction()
    {
        $model = new stdClass();
        $model->displayAlertMessage = $this->displayAlertMessage();

        if (isset($_GET['register'])) {
            $model->register = true;
        } else {
            $model->register = false;
        }

        $this->view($model);
    }

    private function displayAlertMessage()
    {
        if (isset($_GET['error'])) {
            $error = $_GET['error'];

            if ($error == 1) {
                $message = 'Invalid credentials!';
            } else if ($error == 2) {
                $message = 'Passwords do not match!';
            } else if ($error == 3) {
                $message = 'Username already exists!';
            }

            return '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>' . $message . '</strong> Please try again.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        } else if (isset($_GET['success'])) {
            $success = $_GET['success'];

            if ($success == 1) {
                $message = 'Registration successful!';
            }

            return '<div class="alert alert-success alert-dismissible fade show" role="alert">            
                    <strong>' . $message . '</strong> Please login to continue.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
    }

    public function loginAction()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $success = $this->userService->login($username, $password);

        if ($success) {
            header("Location: /");
            exit();
        } else {
            header("Location: /login?error=1");
            exit();
        }
    }

    public function registerAction()
    {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordAgain = $_POST['passwordAgain'];

        if ($password !== $passwordAgain) {
            header("Location: /login?error=2&register=true");
            exit();
        }

        $userExists = $this->userService->checkUserExists($username);
        if ($userExists) {
            header("Location: /login?error=3&register=true");
            exit();
        }

        $this->userService->registerUser($username, $email, $password);

        header("Location: /login?success=1");
        exit();
    }

    public function logoutAction()
    {
        session_unset();
        session_destroy();
        header("Location: /login");
        exit();
    }
}
