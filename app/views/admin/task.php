<div class="container mt-4">
    <h1>Edit Quest</h1>
    <form action="/admin/quest" method="POST">
        <input type="hidden" name="task_id" value="<?= $model->task['task_id'] ?>">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" id="title" value="<?= $model->task['title'] ?>" placeholder="Enter title">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" title="description" rows="4" name="description" placeholder="Enter description"><?= $model->task['description'] ?></textarea>
        </div>
        <div class="mb-3">
            <label for="dueDate" class="form-label">Due Date</label>
            <input type="date" name="due_date" value="<?= $model->task['due_date'] ?>" class="form-control" id="dueDate">
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>