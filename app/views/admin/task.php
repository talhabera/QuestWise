<div class="container mt-4">
    <h1>Edit Quest</h1>
    <form action="" method="POST">
        <input type="hidden" name="task_id" value="<?php $model->task['task_id'] ?>">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" id="title" value="<?php $model->task['title'] ?>" placeholder="Enter title">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" title="description" value="<?php $model->task['description'] ?>" rows="4" placeholder="Enter description"></textarea>
        </div>
        <div class="mb-3">
            <label for="dueDate" class="form-label">Due Date</label>
            <input type="date" name="due_date" value="<?php $model->task['due_date'] ?>" class="form-control" id="dueDate">
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>