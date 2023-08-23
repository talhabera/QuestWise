$(function () {
    $('#dismissModal').click(function () {
        $("#approvalModal").modal('hide');
    });
});

function showErrorModal(message) {
    $('#approveModalLabel').html('Error Occurred');
    $("#approveModalMessage").html(message);

    $('#dismissModal').html('Close');
    $('#dismissModal').removeClass('btn-secondary');
    $('#dismissModal').addClass('btn-danger');

    $('#approveModalBtn').hide();

    $("#approvalModal").modal('show');
}

function showApprovalModal(title, message, callable) {
    $('#approveModalLabel').html(title);
    $("#approveModalMessage").html(message);

    $('#dismissModal').html('No');
    $('#dismissModal').removeClass('btn-danger');
    $('#dismissModal').addClass('btn-secondary');

    $('#approveModalBtn').show();
    $('#approveModalBtn').click(callable);

    $("#approvalModal").modal('show');
}