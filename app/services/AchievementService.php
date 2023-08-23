<?php

class AchievementService
{
    private AchievementRepository $achievementRepository;

    public function __construct(
        AchievementRepository $achievementRepository
    ) {
        $this->achievementRepository = $achievementRepository;
    }

    public function getAchievementPoints($username): int
    {
        $achievementPoints = $this->achievementRepository->getAchievementPoints($username);

        return $achievementPoints;
    }

    public function getAchievements($username): array
    {
        $achievements = $this->achievementRepository->getAchievements($username);
        foreach ($achievements as &$item) {
            if (!$item["achieved_date"]) {
                continue;
            }

            $date = DateTime::createFromFormat("Y-m-d H:i:s", $item["achieved_date"]);
            $formattedDate = $date->format("F d, Y");
            $item["achieved_date"] = $formattedDate;
        }

        return $achievements;
    }

    public function getOtherAchievements($username): array
    {
        $achievements = $this->achievementRepository->getOtherAchievements($username);
        foreach ($achievements as &$item) {
            if (!$item["achieved_date"]) {
                continue;
            }

            $date = DateTime::createFromFormat("Y-m-d H:i:s", $item["achieved_date"]);
            $formattedDate = $date->format("F d, Y");
            $item["achieved_date"] = $formattedDate;
        }

        return $achievements;
    }

    public function getAchievement($id): array
    {
        $achievement = $this->achievementRepository->getAchievement($id);

        return $achievement;
    }

    public function addAchievement($title, $description, $points)
    {
        $this->achievementRepository->addAchievement($title, $description, $points);
    }

    public function updateAchievement($id, $title, $description, $points)
    {
        $this->achievementRepository->updateAchievement($id, $title, $description, $points);
    }

    public function deleteAchievement($id)
    {
        $this->achievementRepository->deleteAchievement($id);
    }

    public function getAchievementByTitle($title)
    {
        $achievement = $this->achievementRepository->getAchievementByTitle($title);

        return $achievement;
    }
}
