<div class="container">
    <h1>Quests Page</h1>

    <!-- Search Form -->
    <form method="GET" action="">
        <div class="mb-3">
            <input type="text" name="searchTitle" class="form-control" placeholder="Search quests...">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <!-- Quests List -->
    <div class="mt-4">
        <?php
        $tasks = $model->tasks;

        foreach ($tasks as $quest) {
            echo '<div class="card mb-3">';
            echo '<div class="card-header">' . $quest['task_id'] . '</div>';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $quest['title'] . '</h5>';
            echo '<p class="card-text">' . $quest['description'] . '</p>';
            echo '<p class="card-text">Due Date: ' . $quest['due_date'] . '</p>';
            echo '<a href="/admin/quest/' . $quest['task_id'] . '" class="btn btn-primary">Edit</a>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
</div>