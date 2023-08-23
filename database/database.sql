-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 22 Ağu 2023, 23:37:15
-- Sunucu sürümü: 10.4.27-MariaDB
-- PHP Sürümü: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `questwise`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `achievements`
--

CREATE TABLE `achievements` (
  `achievement_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  `icon_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `achievements`
--

INSERT INTO `achievements` (`achievement_id`, `title`, `description`, `points`, `icon_url`) VALUES
(1, 'First Task Completed', 'Complete your first task!', 10, 'first_task.png'),
(2, 'Task Master', 'Complete 100 tasks', 100, 'task_master.png'),
(3, 'Achievement Hunter', 'Unlock 5 different achievements', 50, 'achievement_hunter.png'),
(4, 'Super Contributor', 'Post 50 comments', 20, 'super_contributor.png'),
(5, 'Goal Achiever', 'Complete all your tasks for the week', 25, 'goal_achiever.png'),
(7, 'Productivity Pro', 'Complete 500 tasks in total', 150, 'productivity_pro.png'),
(8, 'Punctuality Star', 'Never miss a task deadline for a week', 30, 'punctuality_star.png'),
(11, 'Rising Star', 'Earn 500 points in total', 50, 'rising_star.png'),
(14, 'Persistent Achiever', 'Unlock 10 different achievements', 75, 'persistent_achiever.png'),
(15, 'Task Ninja', 'Complete 1000 tasks in total', 250, 'task_ninja.png'),
(16, 'Novice', 'Completed your first task.', 10, NULL),
(17, 'Apprentice', 'Completed 5 tasks.', 20, NULL),
(18, 'Expert', 'Completed 10 tasks.', 30, NULL),
(19, 'Tasker', 'Completed 25 tasks.', 50, NULL),
(20, 'Overachiever', 'Completed 50 tasks.', 100, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  `comment_text` text DEFAULT NULL,
  `comment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `rewards`
--

CREATE TABLE `rewards` (
  `reward_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `available_quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `rewards`
--

INSERT INTO `rewards` (`reward_id`, `title`, `description`, `cost`, `available_quantity`) VALUES
(1, 'Small Prize', 'A small reward for your achievements.', 10, 100),
(2, 'Medium Prize', 'A medium-sized reward for your efforts.', 25, 50),
(3, 'Large Prize', 'A substantial reward for your hard work.', 50, 25),
(4, 'Special Item', 'A unique and valuable item.', 75, 10),
(5, 'Ultimate Reward', 'The ultimate reward for top performers.', 100, 5);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tasks`
--

CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `assigned_to` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `tasks`
--

INSERT INTO `tasks` (`task_id`, `title`, `description`, `due_date`, `created_by`, `assigned_to`, `status`) VALUES
(1, 'Task One', 'First Task', NULL, 1, 1, 'In Progress'),
(2, 'Task Two', 'Second task', NULL, 1, 1, 'In Progress'),
(3, 'Complete Tutorial', 'Finish the tutorial for the gamification app.', '2023-09-01', 1, 1, 'In Progress'),
(4, 'Daily Exercise', 'Complete at least 30 minutes of exercise today.', '2023-08-22', 1, 1, 'To Do'),
(5, 'Read a Chapter', 'Read a chapter from the book \"Gamification Principles.\"', '2023-08-25', 1, 1, 'To Do'),
(6, 'Write a Blog Post', 'Write a blog post about the benefits of gamified task management.', '2023-08-30', 1, 1, 'Completed'),
(7, 'Client Meeting', 'Prepare for the client meeting at 3:00 PM.', '2023-08-23', 1, 1, 'Completed'),
(8, 'Code Review', 'Review and provide feedback on team member\'s code changes.', '2023-08-24', 1, 1, 'Completed'),
(9, 'Submit Expense Report', 'Submit the expense report for the last business trip.', '2023-08-27', 1, 1, 'Completed'),
(10, 'Design Mockups', 'Create UI/UX design mockups for the new dashboard.', '2023-08-28', 1, 1, 'Completed'),
(11, 'Team Huddle', 'Join the team huddle at 10:00 AM.', '2023-08-22', 1, 1, 'Completed'),
(12, 'Write Documentation', 'Document the new features introduced in the last release.', '2023-08-29', 1, 1, 'In Progress'),
(2350, 'Task 1', 'Complete the first task.', '2023-08-25', 1, 2, 'To Do'),
(2351, 'Task 2', 'Finish the second task.', '2023-08-27', 1, 3, 'In Progress'),
(2352, 'Task 3', 'Complete the third task.', '2023-08-28', 2, 1, 'To Do'),
(2353, 'Task 4', 'Finish the fourth task.', '2023-08-30', 3, 4, 'Completed'),
(2354, 'Task 5', 'Complete the fifth task.', '2023-09-01', 4, 5, 'In Progress');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `task_completions`
--

CREATE TABLE `task_completions` (
  `task_completion_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  `completion_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `task_completions`
--

INSERT INTO `task_completions` (`task_completion_id`, `user_id`, `task_id`, `completion_date`) VALUES
(6, 1, 6, '2023-08-21 15:44:52'),
(7, 1, 7, '2023-08-20 15:44:52'),
(8, 1, 8, '2023-08-19 15:44:52'),
(9, 1, 9, '2023-08-18 15:44:52'),
(10, 1, 10, '2023-08-20 15:10:52'),
(11, 1, 11, '2023-08-22 20:27:55'),
(12, 1, 1, '2023-08-25 07:00:00'),
(13, 2, 2, '2023-08-27 12:30:00'),
(14, 1, 3, '2023-08-28 06:15:00'),
(15, 4, 4, '2023-08-30 15:20:00'),
(16, 5, 5, '2023-09-01 11:45:00');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `join_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `avatar_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `join_date`, `avatar_url`) VALUES
(1, 'talhabera', 'talhabera@protonmail.com', '$2y$10$JvJicbfKgpO3NQWsMY/hFetRpfhJZJvI730oLAbIAVH1gEFxrMKn2', '2023-08-22 08:35:15', 'https://avatars.githubusercontent.com/u/91506632?v=4'),
(2, 'user5', 'user5@example.com', 'hashed_password5', '2023-08-22 21:33:50', 'avatar5.png'),
(3, 'user1', 'user1@example.com', 'hashed_password1', '2023-08-22 21:33:50', 'avatar1.png'),
(4, 'user2', 'user2@example.com', 'hashed_password2', '2023-08-22 21:33:50', 'avatar2.png'),
(5, 'user3', 'user3@example.com', 'hashed_password3', '2023-08-22 21:33:50', 'avatar3.png'),
(6, 'user4', 'user4@example.com', 'hashed_password4', '2023-08-22 21:33:50', 'avatar4.png');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user_achievements`
--

CREATE TABLE `user_achievements` (
  `user_achievement_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `achievement_id` int(11) DEFAULT NULL,
  `achieved_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user_rewards`
--

CREATE TABLE `user_rewards` (
  `user_reward_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `reward_id` int(11) DEFAULT NULL,
  `redeemed_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `achievements`
--
ALTER TABLE `achievements`
  ADD PRIMARY KEY (`achievement_id`);

--
-- Tablo için indeksler `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `task_id` (`task_id`);

--
-- Tablo için indeksler `rewards`
--
ALTER TABLE `rewards`
  ADD PRIMARY KEY (`reward_id`);

--
-- Tablo için indeksler `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `assigned_to` (`assigned_to`);

--
-- Tablo için indeksler `task_completions`
--
ALTER TABLE `task_completions`
  ADD PRIMARY KEY (`task_completion_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `task_id` (`task_id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Tablo için indeksler `user_achievements`
--
ALTER TABLE `user_achievements`
  ADD PRIMARY KEY (`user_achievement_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `achievement_id` (`achievement_id`);

--
-- Tablo için indeksler `user_rewards`
--
ALTER TABLE `user_rewards`
  ADD PRIMARY KEY (`user_reward_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `reward_id` (`reward_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `achievements`
--
ALTER TABLE `achievements`
  MODIFY `achievement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Tablo için AUTO_INCREMENT değeri `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `rewards`
--
ALTER TABLE `rewards`
  MODIFY `reward_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2355;

--
-- Tablo için AUTO_INCREMENT değeri `task_completions`
--
ALTER TABLE `task_completions`
  MODIFY `task_completion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `user_achievements`
--
ALTER TABLE `user_achievements`
  MODIFY `user_achievement_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `user_rewards`
--
ALTER TABLE `user_rewards`
  MODIFY `user_reward_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`task_id`);

--
-- Tablo kısıtlamaları `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`user_id`);

--
-- Tablo kısıtlamaları `task_completions`
--
ALTER TABLE `task_completions`
  ADD CONSTRAINT `task_completions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `task_completions_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`task_id`);

--
-- Tablo kısıtlamaları `user_achievements`
--
ALTER TABLE `user_achievements`
  ADD CONSTRAINT `user_achievements_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `user_achievements_ibfk_2` FOREIGN KEY (`achievement_id`) REFERENCES `achievements` (`achievement_id`);

--
-- Tablo kısıtlamaları `user_rewards`
--
ALTER TABLE `user_rewards`
  ADD CONSTRAINT `user_rewards_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `user_rewards_ibfk_2` FOREIGN KEY (`reward_id`) REFERENCES `rewards` (`reward_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
