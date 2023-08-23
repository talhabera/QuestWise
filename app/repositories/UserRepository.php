<?php

class UserRepository
{
    private DbContext $dbContext;

    public function __construct(DbContext $dbContext)
    {
        $this->dbContext = $dbContext;
    }

    public function getUser($username)
    {
        $sql = "SELECT * FROM users WHERE username = ?";
        $users = $this->dbContext->query($sql, [$username]);

        return !empty($users) ? $users[0] : null;
    }

    public function addUser($username, $email, $hashedPassword): bool
    {
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $result = $this->dbContext->execute($sql, [$username, $email, $hashedPassword]);

        return $result;
    }

    public function checkUserExists($username): bool
    {
        $sql = "SELECT COUNT(*) FROM users WHERE username = ?";
        $result = $this->dbContext->getScalar($sql, [$username]);

        return $result > 0;
    }

    public function getUsers($searchUsername): array
    {
        $sql = "SELECT * FROM users WHERE username LIKE ?";
        $users = $this->dbContext->query($sql, ["%$searchUsername%"]);

        return $users;
    }

    public function updateUser($username, $email, $avatarUrl)
    {
        $sql = "UPDATE users SET email = ?, avatar_url = ? WHERE username = ?";
        $this->dbContext->execute($sql, [$email, $avatarUrl, $username]);
    }
}
