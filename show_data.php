<?php /* Template Name: Show Custom Data */

get_header();
require 'connection.php';
?>
<!doctype html>
<html lang="en">

<body>
    <div class="container ">
        <form class="insert-form" id="insert_form" method="POST">
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="text-center">SHOW DATA</h2>
                        </div>
                    </div>
                    <div class="card-body ">
                        <!-- <fieldset id="buildyourform"> -->
                        <legend>Build your own form</legend>

                        <div id="response_messages"></div>

                        <table class="table table-bordered table-dark" id="table_field">
                            <thead>
                                <tr>
                                    <!-- <th>ID</th> -->
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Dob</th>
                                    <th>Add or Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input class="form-control" type="text" name="name[]" require=""></td>
                                    <td><input class="form-control" type="text" name="email[]" require=""></td>
                                    <td><input class="form-control" type="date" name="dob[]" require=""></td>
                                    <td><input class="btn btn-warning" type="button" name="add" id="add" value="Add"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>

    <div class="form-group" align="center">
        <input type="submit" id="btnSubmit" class="btn btn-info" value="Save Data" />
    </div>
    </form>

    <!-- ----------------------------------------- -->

    <div class="container ">
        <form class="insert-form" id="insert_form" method="POST">
            <div class="row">
                <div class="col-md-12 mt-3" id="show_save_data_form">
                    
                </div>
            </div>
        </form>
    </div>

</body>

</html>


<?php

get_footer();

?>