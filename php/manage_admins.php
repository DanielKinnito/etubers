<?php require_once 'db_connect.php'; ?>
<?php require_once '../includes/header.php'; ?>

<div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="dashboard.php">Home</a></li>          
            <li class="active">Admins</li>
        </ol>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Admins</div>
            </div> <!-- /panel-heading -->
            <div class="panel-body">

                <div class="remove-messages"></div>

                <div class="div-action pull pull-right" style="padding-bottom:20px;">
                    <button class="btn btn-default button1" data-toggle="modal" id="addAdminModalBtn" data-target="#addAdminModal"> <i class="glyphicon glyphicon-plus-sign"></i> Add Admin </button>
                </div> <!-- /div-action -->              
                
                <?php
                // Fetch data from the "admins" table
                $sql = "SELECT * FROM Admins";
                $table = $connect->query($sql);

                if ($table->num_rows > 0) {
                    // Output table header
                    echo '<table class="table" id="manageAdminTable">
                            <thead>
                                <tr>
                                    <th style="width:10%;">Admin ID</th>                            
                                    <th>First Name</th>
                                    <th>Last Name</th>                            
                                    <th>Admin Level</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>';

                    // Output data rows
                    while ($row = $table->fetch_assoc()) {
                        echo '<tr>
                                <td>' . $row['AdminID'] . '</td>
                                <td>' . $row['FirstName'] . '</td>
                                <td>' . $row['LastName'] . '</td>
                                <td>' . $row['AdminLevel'] . '</td>
                                <td>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#editAdminModal" data-id="' . $row['AdminID'] . '">Edit</button>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#removeAdminModal" data-id="' . $row['AdminID'] . '">Delete</button>
                                </td>
                            </tr>';
                    }

                    // Close the table
                    echo '</tbody></table>';
                } else {
                    echo '<p>No admins found.</p>';
                }
                $connect->close();
                // Close the database connection
                ?>

                <!-- /table -->

            </div> <!-- /panel-body -->
        </div> <!-- /panel -->      
    </div> <!-- /col-md-12 -->
</div> <!-- /row -->

<!-- add Admin -->
<div class="modal fade" id="addAdminModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

        <form class="form-horizontal" id="submitAdminForm" action="php_action/createAdmin.php" method="POST">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><i class="fa fa-plus"></i> Add Admin</h4>
          </div>

          <div class="modal-body" style="max-height:450px; overflow:auto;">

            <div id="add-admin-messages"></div>
                        
            <div class="form-group">
                <label for="firstName" class="col-sm-3 control-label">First Name: </label>
                <label class="col-sm-1 control-label">: </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="firstName" placeholder="First Name" name="firstName" autocomplete="off">
                </div>
            </div> <!-- /form-group-->   

            <div class="form-group">
                <label for="lastName" class="col-sm-3 control-label">Last Name: </label>
                <label class="col-sm-1 control-label">: </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="lastName" placeholder="Last Name" name="lastName" autocomplete="off">
                </div>
            </div> <!-- /form-group-->    

            <div class="form-group">
                <label for="adminLevel" class="col-sm-3 control-label">Admin Level: </label>
                <label class="col-sm-1 control-label">: </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="adminLevel" placeholder="Admin Level" name="adminLevel" autocomplete="off">
                </div>
            </div> <!-- /form-group-->        

          </div> <!-- /modal-body -->
          
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
            
            <button type="submit" class="btn btn-primary" id="createAdminBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
          </div> <!-- /modal-footer -->      
        </form> <!-- /.form -->     
    </div> <!-- /modal-content -->    
  </div> <!-- /modal-dailog -->
</div> <!-- /add admin modal -->

<!-- edit Admin -->
<div class="modal fade" id="editAdminModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

        <form class="form-horizontal" id="editAdminForm" action="php_action/editAdmin.php" method="POST">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Admin</h4>
          </div>

          <div class="modal-body" style="max-height:450px; overflow:auto;">

            <div id="edit-admin-messages"></div>
                        
            <div class="form-group">
                <label for="editFirstName" class="col-sm-3 control-label">First Name: </label>
                <label class="col-sm-1 control-label">: </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="editFirstName" placeholder="First Name" name="editFirstName" autocomplete="off">
                </div>
            </div> <!-- /form-group-->   

            <div class="form-group">
                <label for="editLastName" class="col-sm-3 control-label">Last Name: </label>
                <label class="col-sm-1 control-label">: </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="editLastName" placeholder="Last Name" name="editLastName" autocomplete="off">
                </div>
            </div> <!-- /form-group-->    

            <div class="form-group">
                <label for="editAdminLevel" class="col-sm-3 control-label">Admin Level: </label>
                <label class="col-sm-1 control-label">: </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="editAdminLevel" placeholder="Admin Level" name="editAdminLevel" autocomplete="off">
                </div>
            </div> <!-- /form-group-->        

          </div> <!-- /modal-body -->
          
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
            
            <button type="submit" class="btn btn-primary" id="editAdminBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
          </div> <!-- /modal-footer -->      
        </form> <!-- /.form -->     
    </div> <!-- /modal-content -->    
  </div> <!-- /modal-dailog -->
</div> <!-- /edit admin modal -->

<!-- remove Admin -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeAdminModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Admin</h4>
      </div>
      <div class="modal-body">

        <div class="removeAdminMessages"></div>

        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeAdminFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeAdminBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.remove admin modal -->

<script src="../js/admin.js"></script>

<?php require_once '../includes/footer.php'; ?>
