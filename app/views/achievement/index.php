<div id="achievement" class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">My Achievement</h1>
    </div>

    <div class="row">
        <?php foreach ($model->achievements as $item) : ?>
            <div class="col-md-4">
                <div class="achievement-card">
                    <?php if ($item['icon_url']) : ?>
                        <img src="/questwise/resources/images/achievements/<?= $item['icon_url'] ?>" width="50" height="50" class="achievement-icon">
                    <?php else : ?>
                        <img src="/questwise/resources/images/achievements/default.png" width="50" height="50" class="achievement-icon">
                    <?php endif; ?>
                    <h5 class="mt-3"><?= $item['title'] ?> <span class="points-value"><?= $item['points'] ?></span></h5>
                    <p class="text-muted">Earned on: <?= $item['achieved_date'] ?></p>
                    <p><?= $item['description'] ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Other Achievements</h1>
    </div>

    <div class="row">
        <?php foreach ($model->otherAchievements as $item) : ?>
            <div class="col-md-4">
                <div class="achievement-card">
                    <?php if ($item['icon_url']) : ?>
                        <img src="/questwise/resources/images/achievements/<?= $item['icon_url'] ?>" width="50" height="50" class="achievement-icon">
                    <?php else : ?>
                        <img src="/questwise/resources/images/achievements/default.png" width="50" height="50" class="achievement-icon">
                    <?php endif; ?>
                    <h5 class="mt-3"><?= $item['title'] ?> <span class="points-value"><?= $item['points'] ?></span></h5>
                    <p><?= $item['description'] ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</div>