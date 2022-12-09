<script type="text/javascript">
    $(document).ready(function() {
        // event.preventDefault();
        get_show_form_data();


        // alert('ok');
        var html = '<tr></td><td><input class="form-control" type="text" name="name[]" require=""></td><td><input class="form-control" type="text" name="email[]" require=""></td><td><input class="form-control" type="date" name="dob[]" require=""></td><td><input class="btn btn-danger" type="button" name="remove" id="remove" value="Remove"></td></tr>';

        var x = 1;

        jQuery("#add").click(function() {
            // alert('ok');
            jQuery("#table_field").append(html);
        });
        jQuery("#table_field").on('click', '#remove', function() {
            alert('you want to sure to delete')
            jQuery(this).closest('tr').remove();
        });

        jQuery('#insert_form').submit(function(event) {
            event.preventDefault();
            // alert('ok');
            var link = "<?php echo admin_url('admin-ajax.php') ?>";
            let formData = new FormData(this);
            console.log(formData);
            formData.append("action", "show_data_forms");
            // console.log(formData);
            jQuery.ajax({
                url: link,
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'JSON',
                success: function(result) {
                    if (result.code === 200) {
                        get_show_form_data();
                        jQuery("#insert_form")[0].reset();
                        jQuery('#response_messages').html('<div class="alert alert-success alert-dismissible">\
                        <button type="button" class="close" data-dismiss="alert">&times;</button>\
                        <strong>Success!</strong> ' + result.message + '\
                        </div>');

                        // setTimeout(function() {

                        // swal("Good job!", "You clicked the button!", "success");

                        window.location.reload();
                        // }, 100);
                    }
                }
            });
        });

        // jQuery('#getdata').on('click', function(e) {

        //     jQuery("#save_data").toggle();
        //     jQuery(this).toggleClass()
        // });
        // jQuery("#getdata").click(function(event) {
        //     event.preventDefault();
        //     jQuery("#save_data").show();
        // });
        // jQuery("#getdata").click(function(event) {
        //     event.preventDefault();
        //     jQuery("#save_data").hide();
        // });

        jQuery("#getdata").click(function() {
            // alert('ok');
            jQuery("#save_data").append(html);
        });

        var link = "<?php echo admin_url('admin-ajax.php') ?>";
        let formData = new FormData(this);
        formData.append("action", "get_datas");
        jQuery.ajax({
            url: link,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'JSON',
            success: function(res) {
                alert('ok');
                if (res.code === 200) {

                }
            }
        });
    });

    // ----------------------------------------------------------------------------

    function get_show_form_data() {
        var link = "<?php echo admin_url('admin-ajax.php') ?>";
        jQuery.ajax({
            url: link,
            type: 'GET',
            data: {
                action: 'get_data_action',
                param: 'get_data_param'
            },
            dataType: 'JSON',
            success: function(resp) {
                console.log(resp);
                if (resp.code === 200) {
                    let html_table = '';
                    html_table = "<table class='table table-bordered'id='table_field'><thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Dob</th></tr></thead></table></div>";
                    jQuery.each(resp.data, function(key, value) {
                        let table_values = '';
                        jQuery.each(value.user_info, function(key, value_user_info) {
                            table_values += "<table class='table table-bordered'><tr>\
                                <td><input class='form-control' type='text' name='id[]' value='" + value['id'] + "' disabled></td>\
                                <td><input class='form-control' type='text' name='name[]' value='" + value_user_info['name'] + "'></td>\
                                <td><input class='form-control' type='text' name='email[]' value='" + value_user_info['email'] + "'></td>\
                                <td><input class='form-control' type='date' name='dob[]' value='" + value_user_info['dob'] + "'></td>\
                            </tr></table>";
                        });
                        html_table += "<tbody>" + table_values + "</tbody>";
                    });
                    jQuery('#show_save_data_form').html(html_table);
                }
            }
        });
    }
</script>