<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuestWise - Task Management with Gamification</title>
    <meta name="description" content="QuestWise is a gamified task management website that helps you stay productive and motivated in completing your tasks. Embark on quests, earn rewards, and level up your productivity!">
    <meta name="keywords" content="QuestWise, task management, gamification, productivity, quests, rewards, level up">
    <meta name="author" content="Your Name or Company Name">

    <!-- Favicon -->
    <link rel="icon" href="/resources/icon.png" type="image/png">

    <!-- External CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="/resources/css/custom.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Your+Google+Font:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <!-- OpenGraph -->
    <meta property="og:title" content="QuestWise - Task Management with Gamification">
    <meta property="og:description" content="QuestWise is a gamified task management website that helps you stay productive and motivated in completing your tasks. Embark on quests, earn rewards, and level up your productivity!">
    <meta property="og:image" content="/resources/images/questwise.png">
    <meta property="og:url" content="https://www.questwise.app">
    <meta property="og:type" content="website">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="QuestWise - Task Management with Gamification">
    <meta name="twitter:description" content="QuestWise is a gamified task management website that helps you stay productive and motivated in completing your tasks. Embark on quests, earn rewards, and level up your productivity!">
    <meta name="twitter:image" content="/resources/images/questwise.png">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">QuestWise</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Quests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Rewards</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Profile</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div id="content" class="wrapper">
        <?php require_once $contentView; ?>
    </div>

    <!-- Footer -->
    <footer class="footer bg-light text-center py-3">
        <div class="container">
            &copy; 2023 QuestWise - Task Management with Gamification. All rights reserved.
        </div>
    </footer>

    <!-- External JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    <!-- Custom JS -->
    <script src="/resources/js/custom.js" defer></script>
</body>

</html>