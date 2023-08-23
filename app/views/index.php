<!DOCTYPE html>
<html data-bs-theme="dark">

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
    <link href="https://fonts.googleapis.com/css2?family=Kanit" rel="stylesheet">

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
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="/resources/images/questwise_nobg.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
                QuestWise
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/quests">Quests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/achievements">Achievements</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/users">Users</a>
                    </li>
                    <?php if (isset($_SESSION['username'])) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php if (isset($_SESSION['user_avatar'])) : ?>
                                    <img src="<?php echo $_SESSION['user_avatar']; ?>" id="userAvatar" alt="User Avatar" width="30" height="30" class="rounded-circle">
                                <?php else : ?>
                                    <img src="/resources/images/default_avatar.jpg" id="userAvatar" alt="User Avatar" width="30" height="30" class="rounded-circle">
                                <?php endif; ?>
                                <?php echo $_SESSION['username']; ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="/user/<?= $_SESSION['username'] ?>">Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="/logout">Logout</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <div class="points-display shadow-sm">
                                <span class="points-icon">
                                    <img src="/resources/images/point.png" alt="Point Icon" width="20" height="20">
                                </span>
                                <span class="points-value"><?php echo $_SESSION['user_point'] ?></span>
                            </div>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <main id="content" class="col-12 pt-3" id="content">
                <?php require_once $contentView; ?>
            </main>
        </div>
    </div>

    <footer class="footer text-center py-3">
        <div class="container">
            &copy; 2023 QuestWise - Task Management with Gamification. All rights reserved.
        </div>
    </footer>

    <div class="modal fade" id="approvalModal" tabindex="-1" role="dialog" aria-labelledby="approvalModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="approveModalLabel"></h5>
                </div>
                <div class="modal-body">
                    <p id="approveModalMessage"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" id="dismissModal" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary" id="approveModalBtn">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- External JS -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Custom JS -->
    <script src="/resources/js/custom.js" defer></script>
    <?php
    $contentViewJsPath = str_replace('.php', '.js', $contentView); // Replaces ".php" with ".js"
    $contentViewJsPath = str_replace('../app/views/', '/resources/js/', $contentViewJsPath); // Replaces the path segment

    if (file_exists($_SERVER['DOCUMENT_ROOT'] . $contentViewJsPath)) {
        echo '<script src="' . $contentViewJsPath . '" defer></script>';
    }
    ?>
</body>

</html>