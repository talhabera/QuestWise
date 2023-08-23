<div class="container mt-5">
    <h1>Add Task</h1>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text"  class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control"  id="description" name="description" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="due_date" class="form-label">Due Date</label>
            <input type="date" class="form-control" id="due_date" name="due_date">
        </div>
        <button type="submit" class="btn btn-primary">Add Task</button>
    </form>
</div>