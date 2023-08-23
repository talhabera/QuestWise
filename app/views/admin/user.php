<div class="container mt-4">
    <h1>Edit User</h1>
    <form action="/questwise/admin/user" method="POST">
        <input type="hidden" name="username" value="<?= $model->user['username'] ?>">
        <div class="mb-3">
            <label for="username" class="form-label">Username: <?= $model->user['username'] ?></label>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="<?= $model->user['email'] ?>" placeholder="Enter email">
        </div>
        <div class="mb-3">
            <label for="avatar" class="form-label">Avatar URL</label>
            <input type="url" class="form-control" name="avatar_url" id="avatar" value="<?= $model->user['avatar_url'] ?>" placeholder="Enter avatar URL">
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>