<?php

class AdminService
{
    private AdminRepository $adminRepository;

    public function __construct(
        AdminRepository $adminRepository,
    ) {
        $this->adminRepository = $adminRepository;
    }

    public function login(string $username, string $password)
    {
        $admin = $this->adminRepository->getByUsername($username);

        if ($admin == null) {
            return 'Invalid username or password.';
        }

        if (!password_verify($password, $admin->password)) {
            return 'Invalid username or password.';
        }

        $_SESSION['admin_username'] = $admin->username;
        return true;
    }
}
