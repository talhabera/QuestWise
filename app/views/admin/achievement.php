<div class="container mt-4">
    <h1>Edit Achievement</h1>
    <form action="/questwise/admin/achievement" method="POST">
        <input type="hidden" name="achievement_id" value="<?= $model->achievement['achievement_id'] ?>">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" id="title" value="<?= $model->achievement['title'] ?>" placeholder="Enter achievement title">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" value="<?= $model->achievement['description'] ?>" placeholder="Enter achievement description"></textarea>
        </div>
        <div class="mb-3">
            <label for="points" class="form-label">Points</label>
            <input type="number" class="form-control" name="points" id="points" value="<?= $model->achievement['points'] ?>" placeholder="Enter achievement points">
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>