<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Page Not Found</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .error-container {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="error-container">
        <h1 class="display-1">404</h1>
        <p class="lead">Page not found</p>
        <p>The page you are looking for might have been removed or is temporarily unavailable.</p>
        <?php if (DEVELOPER_MSG) : ?>
            <p>Developer message: <?= $error ?></p>
        <?php endif; ?>
    </div>
</body>

</html>