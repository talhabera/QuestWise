<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header">
                    User Details
                </div>
                <div class="card-body">
                    <?php if ($model->user['avatar_url']) : ?>
                        <img src="<?= $model->user['avatar_url'] ?>" width="150" height="150" class="user-icon mb-2">
                    <?php else : ?>
                        <img src="/resources/images/default_avatar.jpg" width="150" height="150" class="user-icon mb-3">
                    <?php endif; ?>
                    <h5 class="card-title">Username: <?= $model->user['username'] ?></h5>
                    <p class="card-text"><strong>Email :</strong><?= $model->user['email'] ?></p>
                    <p class="card-text"><strong>Join Date:</strong><?= $model->user['join_date'] ?></p>
                    <p class="card-text"><strong>Points:</strong> <?= $model->userPoints ?></p>
                    <p class="card-text"><strong>Total Completed Tasks:</strong> <?= $model->totalCompletedTasks ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">
                    Weekly Completed Tasks Chart
                </div>
                <div class="card-body">
                    <canvas id="weeklyChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="weeklyCompletedTasks" value="<?= htmlspecialchars(json_encode($model->weeklyCompletedTasks), ENT_QUOTES, 'UTF-8'); ?>">