<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    Quest Details
                </div>
                <div class="card-body d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="card-title"><?php echo $model->task["title"] ?></h5>
                        <p class="card-text"><?php echo $model->task["description"] ?></p>
                        <p class="card-text"><strong>Assigned to: </strong><?php echo $model->task["assigned_to_username"] ?></p>
                        <p class="card-text"><strong>Created By: </strong><?php echo $model->task["created_by_username"] ?></p>
                        <p class="card-text"><strong>Due Date: </strong><?php echo $model->task["due_date"] ?></p>
                        <p class="card-text"><strong>Status: </strong><?php echo $model->task["status"] ?></p>
                    </div>
                    <?php if ($model->task["status"] == "To Do") : ?>
                        <button id="startTask" type="button" class="btn btn-success">Start Task</button>
                    <?php elseif ($model->task["status"] == "In Progress") : ?>
                        <button id="completeTask" type="button" class="btn btn-success">Complete Task</button>
                    <?php endif; ?>
                </div>
            </div>
            <div class="mt-4">
                <h4>Comments</h4>
                <ul class="list-group">
                    <?php if (!$model->comments) : ?>
                        <li class="card p-2 py-3 my-2">
                            <div class="card-body">
                                No comments yet.
                            </div>
                        </li>
                    <?php endif; ?>
                    <?php foreach ($model->comments as $comment) : ?>
                        <li class="card p-2 py-3 my-2">
                            <div class="card-header d-flex justify-content-between">
                                <div>
                                    <img src="<?= $comment["avatar_url"] ?>" id="userAvatar" alt="User Avatar" width="25" height="25" class="rounded-circle">
                                    <?= $comment["username"] ?>
                                </div>
                                <i class="font-italic"><?= $comment["comment_date"] ?></i>
                            </div>
                            <div class="card-body">
                                <?= $comment["comment_text"] ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="mt-4">
                <h4>Add Comment</h4>
                <input type="hidden" id="taskId" value="<?php echo $model->task["task_id"] ?>">
                <div class="mb-3">
                    <textarea class="form-control" id="comment" rows="3" placeholder="Write your comment here..."></textarea>
                </div>
                <button id="sendComment" type="button" class="btn btn-primary">Send Comment</button>
            </div>
        </div>
    </div>
</div>