$(function () {
    $('#completeTask').click(function () {
        prepareCompleteTask();
    });

    $('#startTask').click(function () {
        prepareStartTask();
    });

    $('#sendComment').click(function () {
        sendComment();
    });
});

async function sendComment() {
    try {
        const taskId = $("#taskId").val();
        const comment = $("#comment").val();

        const response = await postComment(taskId, comment);

        if (response !== '1' && response !== 1) {
            showErrorModal('Comment could not be sent.' + response);
            return;
        }

        window.location.reload();
    } catch (error) {
        showErrorModal("An error occurred. Please try again later.");
    }
}

async function postComment(taskId, comment) {
    const url = '/send-comment';

    const formData = new FormData();
    formData.append('taskId', taskId);
    formData.append('comment', comment);

    const response = await fetch(url, {
        method: 'POST',
        body: formData
    });

    if (response.ok) {
        const result = await response.text();
        return result;
    } else {
        const errorText = await response.text();
        throw new Error(errorText);
    }
}

function prepareStartTask() {
    showApprovalModal('Start Task',
        'Are you sure you want to start this task?',
        function () {
            var id = $('#taskId').val();
            var url = '/start-quest/' + id;

            $.ajax({
                url: url,
                method: 'POST',
                success: function (response) {
                    if (response == 1) {
                        window.location.reload();
                    }
                },
                error: function (response) {
                    showErrorModal(response);
                }
            });

            $("#approvalModal").modal('hide');
        });
}

function prepareCompleteTask() {
    $('#approveModalLabel').html('Complete Task');
    $("#approveModalMessage").html('Are you sure you want to complete this task?');

    $("#approveModalBtn").click(function () {
        var id = $('#taskId').val();
        var url = '/complete-quest/' + id;

        $.ajax({
            url: url,
            method: 'POST',
            success: function (response) {
                if (response == 1) {
                    window.location.href = '/quests';
                }
            },
            error: function (response) {
                showErrorModal(response);
            }
        });

        $("#approvalModal").modal('hide');
    });

    $("#approvalModal").modal('show');
}