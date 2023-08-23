<div id="users" class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">User Search</h1>
            </div>

            <form class="mb-4" action="/questwise/admin/users" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" name="searchUsername" placeholder="Search by username">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>

            <div class="search-results">
                <?php foreach ($model->users as $user) : ?>
                    <a href="/questwise/admin/user/<?= $user['username'] ?>" class="text-decoration-none">
                        <div class="card mb-3">
                            <div class="user-detail d-flex align-items-center p-3">
                                <?php if ($user['avatar_url']) : ?>
                                    <img src="<?= $user['avatar_url'] ?>" width="50" height="50" class="user-icon rounded-circle me-3">
                                <?php else : ?>
                                    <img src="/questwise/resources/images/default_avatar.jpg" width="50" height="50" class="user-icon rounded-circle me-3">
                                <?php endif; ?>
                                <div>
                                    <h2 class="mb-0"><?php echo $user['username']; ?></h2>
                                    <p class="mb-1">Email: <?php echo $user['email']; ?></p>
                                    <p class="mb-0">Join Date: <?php echo $user['join_date']; ?></p>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>