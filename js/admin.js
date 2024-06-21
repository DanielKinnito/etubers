$(document).ready(function() {
    // Add admin form submission
    $("#submitAdminForm").unbind('submit').bind('submit', function() {
        var form = $(this);
        var formData = new FormData(this);

        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: formData,
            dataType: 'json',
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success === true) {
                    $("#addAdminModal").modal('hide');
                    // Update the manage admin table
                } else {
                    // Show error message
                }
            }
        });

        return false;
    });

    // Edit admin form submission
    $("#editAdminForm").unbind('submit').bind('submit', function() {
        var form = $(this);
        var formData = new FormData(this);

        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: formData,
            dataType: 'json',
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success === true) {
                    $("#editAdminModal").modal('hide');
                    // Update the manage admin table
                } else {
                    // Show error message
                }
            }
        });

        return false;
    });

    // Remove admin
    $("#removeAdminBtn").on('click', function() {
        var adminID = $(this).data('id');

        $.ajax({
            url: 'action/removeAdmin.php',
            type: 'post',
            data: { adminID: adminID },
            dataType: 'json',
            success: function(response) {
                if (response.success === true) {
                    $("#removeAdminModal").modal('hide');
                    // Update the manage admin table
                } else {
                    // Show error message
                }
            }
        });
    });
});
