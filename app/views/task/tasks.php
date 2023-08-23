<div id="tasks" class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">My Quests</h1>
        <a class="btn btn-primary" href="/add-quest">
            Create Quest
        </a>
    </div>

    <div class="row row-cols-1 row-cols-md-2 g-4">
        <?php foreach ($model->tasks as $task) : ?>
            <div class="col task-card">
                <a href="quest/<?php echo $task['task_id'] ?>" class="text-decoration-none">
                    <div class="card">
                        <div class="card-header">
                            Due Date:
                            <?php
                            if ($task['due_date'])
                                echo $task['due_date'];
                            else
                                echo "No due date";
                            ?>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $task['title']; ?></h5>
                            <p class="card-text">Status: <?php echo $task['status']; ?></p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 mt-5 border-bottom">
        <h1 class="h2">Completed Quests</h1>
    </div>

    <div class="row row-cols-1 row-cols-md-2 g-4">
        <?php foreach ($model->completedTasks as $task) : ?>
            <div class="col task-card">
                <a href="quest/<?php echo $task['task_id'] ?>" class="text-decoration-none">
                    <div class="card">
                        <div class="card-header">
                            Completion Date:
                            <?= $task['completion_date']; ?>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $task['title']; ?></h5>
                            <p class="card-text">Status: <?php echo $task['status']; ?></p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>

</div>