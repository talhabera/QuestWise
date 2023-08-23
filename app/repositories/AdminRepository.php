<?php

class AdminRepository
{
    private DbContext $dbContext;

    public function __construct(DbContext $dbContext)
    {
        $this->dbContext = $dbContext;
    }

    public function getByUsername(string $username)
    {
        $sql = "SELECT * FROM admins WHERE username = :username";
        $params = [
            'username' => $username
        ];

        $result = $this->dbContext->query($sql, $params);

        if (count($result) == 0) {
            return null;
        }

        $admin = new stdClass();
        $admin->id = $result[0]['id'];
        $admin->username = $result[0]['username'];
        $admin->password = $result[0]['password'];

        return $admin;
    }
}
