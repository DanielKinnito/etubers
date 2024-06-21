var manageMaterialTable;

$(document).ready(function() {
    // top nav bar
    $('#navMaterial').addClass('active');
    // manage material data table
    manageMaterialTable = $('#manageMaterialTable').DataTable({
        'ajax': 'fetchMaterial.php', // Update the URL to match your PHP file
        'order': []
    });

    // add material modal btn clicked
    $("#addMaterialModalBtn").unbind('click').bind('click', function() {
        // material form reset
        $("#submitMaterialForm")[0].reset();

        // remove text-error
        $(".text-danger").remove();
        // remove from-group error
        $(".form-group").removeClass('has-error').removeClass('has-success');

        // submit Material form
        $("#submitMaterialForm").unbind('submit').bind('submit', function() {
            // form validation
            var materialID = $("#materialID").val();
            var materialName = $("#materialName").val();
            var unit = $("#unit").val();
            var unitPrice = $("#unitPrice").val();
            var quantity = $("#quantity").val();

            if (materialID == "") {
                $("#materialID").after('<p class="text-danger">Material ID field is required</p>');
                $('#materialID').closest('.form-group').addClass('has-error');
            } else {
                // remove error text field
                $("#materialID").find('.text-danger').remove();
                // success out for form
                $("#materialID").closest('.form-group').addClass('has-success');
            }

            if (materialName == "") {
                $("#materialName").after('<p class="text-danger">Material Name field is required</p>');
                $('#materialName').closest('.form-group').addClass('has-error');
            } else {
                // remove error text field
                $("#materialName").find('.text-danger').remove();
                // success out for form
                $("#materialName").closest('.form-group').addClass('has-success');
            }

            if (quantity == "") {
                $("#quantity").after('<p class="text-danger">Quantity field is required</p>');
                $('#quantity').closest('.form-group').addClass('has-error');
            } else {
                // remove error text field
                $("#quantity").find('.text-danger').remove();
                // success out for form
                $("#quantity").closest('.form-group').addClass('has-success');
            }

            if (unit == "") {
                $("#unit").after('<p class="text-danger">Unit field is required</p>');
                $('#unit').closest('.form-group').addClass('has-error');
            } else {
                // remove error text field
                $("#unit").find('.text-danger').remove();
                // success out for form
                $("#unit").closest('.form-group').addClass('has-success');
            }

            if (unitPrice == "") {
                $("#unitPrice").after('<p class="text-danger">Unit Price field is required</p>');
                $('#unitPrice').closest('.form-group').addClass('has-error');
            } else {
                // remove error text field
                $("#unitPrice").find('.text-danger').remove();
                // success out for form
                $("#unitPrice").closest('.form-group').addClass('has-success');
            }

            if (materialID && materialName && unit && unitPrice && quantity) {
                // submit loading button
                $("#createMaterialBtn").button('loading');

                var form = $(this);
                var formData = new FormData(this);

                $.ajax({
                    url: 'php_action/createMaterial.php', // Update the URL to match your PHP file for adding materials
                    type: form.attr('method'),
                    data: formData,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {

                        if (response.success == true) {
                            // submit loading button
                            $("#createMaterialBtn").button('reset');

                            $("#submitMaterialForm")[0].reset();

                            $("html, body, div.modal, div.modal-content, div.modal-body").animate({
                                scrollTop: '0'
                            }, 100);

                            // shows a successful message after operation
                            $('#add-material-messages').html('<div class="alert alert-success">' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                '</div>');

                            // remove the messages
                            $(".alert-success").delay(500).show(10, function() {
                                $(this).delay(3000).hide(10, function() {
                                    $(this).remove();
                                });
                            }); // /.alert

                            // reload the manage material table
                            manageMaterialTable.ajax.reload(null, true);

                            // remove text-error
                            $(".text-danger").remove();
                            // remove from-group error
                            $(".form-group").removeClass('has-error').removeClass('has-success');

                        } // /if response.success

                    } // /success function
                }); // /ajax function
            } // /if validation is ok                     

            return false;
        }); // /submit material form

    }); // /add material modal btn clicked

    // remove material
    removeMaterial();
});

function removeMaterial() {
    $("#removeMaterialModalBtn").unbind('click').bind('click', function() {
        var materialID = $(this).data('id');
        // remove product button clicked
        $("#removeMaterialBtn").unbind('click').bind('click', function() {
            // loading remove button
            $("#removeMaterialBtn").button('loading');
            $.ajax({
                url: 'php_action/removeMaterial.php', // Update the URL to match your PHP file for removing materials
                type: 'post',
                data: {
                    materialID: materialID
                },
                dataType: 'json',
                success: function(response) {
                    // loading remove button
                    $("#removeMaterialBtn").button('reset');
                    if (response.success == true) {
                        // remove product modal
                        $("#removeMaterialModal").modal('hide');

                        // update the material table
                        manageMaterialTable.ajax.reload(null, false);

                        // remove success messages
                        $(".removeMaterialMessages").html('<div class="alert alert-success">' +
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                            '</div>');

                        // remove the messages
                        $(".alert-success").delay(500).show(10, function() {
                            $(this).delay(3000).hide(10, function() {
                                $(this).remove();
                            });
                        }); // /.alert
                    } else {

                        // remove success messages
                        $(".removeMaterialMessages").html('<div class="alert alert-success">' +
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                            '</div>');

                        // remove the messages
                        $(".alert-success").delay(500).show(10, function() {
                            $(this).delay(3000).hide(10, function() {
                                $(this).remove();
                            });
                        }); // /.alert

                    } // /error
                } // /success function
            }); // /ajax function
            return false;
        }); // /remove material btn clicked
    }); // /remove material modal btn clicked
}
