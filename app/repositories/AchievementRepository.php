<?php

class AchievementRepository
{
    private DbContext $dbContext;

    public function __construct(DbContext $dbContext)
    {
        $this->dbContext = $dbContext;
    }

    public function getAchievementPoints($username): int
    {
        $sql = "SELECT SUM(points) FROM achievements WHERE achievement_id IN (SELECT achievement_id FROM user_achievements WHERE user_id IN (SELECT user_id FROM users WHERE username = :username))";
        $params = array(":username" => $username);
        $result = $this->dbContext->getScalar($sql, $params);

        return $result;
    }

    public function getAchievements($username): array
    {
        $sql = "SELECT a.*, ua.achieved_date
                FROM achievements as a 
                INNER JOIN user_achievements as ua ON a.achievement_id = ua.achievement_id
                WHERE ua.user_id IN (SELECT user_id FROM users WHERE username = :username)";
        $params = array(":username" => $username);
        $result = $this->dbContext->query($sql, $params);

        return $result;
    }

    public function getOtherAchievements($username): array
    {
        $sql = "SELECT a.*, ua.achieved_date
                FROM achievements as a 
                LEFT JOIN user_achievements as ua ON a.achievement_id = ua.achievement_id
                WHERE ua.user_id IS NULL OR ua.user_id NOT IN (SELECT user_id FROM users WHERE username = :username)";
        $params = array(":username" => $username);
        $result = $this->dbContext->query($sql, $params);

        return $result;
    }

    public function getAchievement($id): array
    {
        $sql = "SELECT * FROM achievements WHERE achievement_id = :id";
        $params = array(":id" => $id);
        $result = $this->dbContext->query($sql, $params);

        return $result;
    }

    public function addAchievement($title, $description, $points)
    {
        $sql = "INSERT INTO achievements (title, description, points) VALUES (:title, :description, :points)";
        $params = array(":title" => $title, ":description" => $description, ":points" => $points);
        $result = $this->dbContext->execute($sql, $params);

        return $result;
    }

    public function addAchievementToUser($achievementId, $username)
    {
        $sql = "INSERT INTO user_achievements (achievement_id, user_id, achieved_date) VALUES (:achievement_id, (SELECT user_id FROM users WHERE username = :username), NOW())";
        $params = array(":achievement_id" => $achievementId, ":username" => $username);
        $result = $this->dbContext->execute($sql, $params);

        return $result;
    }

    public function updateAchievement($id, $title, $description, $points)
    {
        $sql = "UPDATE achievements SET title = :title, description = :description, points = :points WHERE achievement_id = :id";
        $params = array(":id" => $id, ":title" => $title, ":description" => $description, ":points" => $points);
        $result = $this->dbContext->execute($sql, $params);

        return $result;
    }

    public function deleteAchievement($id)
    {
        $sql = "DELETE FROM achievements WHERE achievement_id = :id";
        $params = array(":id" => $id);
        $result = $this->dbContext->execute($sql, $params);

        return $result;
    }

    public function deleteAchievementFromUser($achievementId, $username)
    {
        $sql = "DELETE FROM user_achievements WHERE achievement_id = :achievement_id AND user_id = (SELECT user_id FROM users WHERE username = :username)";
        $params = array(":achievement_id" => $achievementId, ":username" => $username);
        $result = $this->dbContext->execute($sql, $params);

        return $result;
    }

    public function checkAchievementExists($id): bool
    {
        $sql = "SELECT COUNT(*) FROM achievements WHERE achievement_id = :id";
        $params = array(":id" => $id);
        $result = $this->dbContext->getScalar($sql, $params);

        return $result > 0;
    }

    public function getAchievementByTitle($title): array|null
    {
        $sql = "SELECT * FROM achievements WHERE title = :title";
        $params = array(":title" => $title);
        $result = $this->dbContext->query($sql, $params);

        return !empty($result) ? $result[0] : null;
    }
}
