<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 Internal Server Error</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
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
        <h1 class="display-1">500</h1>
        <p class="lead">Internal Server Error</p>
        <p>Sorry, something went wrong on our end. We're working to fix the issue.</p>
        <?php if (DEVELOPER_MSG) : ?>
            <p>Developer message: <?= $error ?></p>
        <?php endif; ?>
    </div>
</body>

</html>