<?php
require "../include/cn.php";
if (!isset($_SESSION)) {
    session_start();
    $sql = "SELECT tblnoa.*, tbladmission.name, tbladmission.address, tbladmission.telephone, tbladmission.cellphone, tbladmission.email FROM tblnoa INNER  JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno";
    $result = $conn->query($sql);
}
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}
include_once "gui.php";
?>

<script>
    function gotoModal(id) {
        $('#delete').modal('toggle');
        $('#id').val(id);
    }
</script>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header">
                <span class="fas fa-users"></span>
                Notice Of Admission
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <table id="myTable" class="table display table-responsive table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Date Released</th>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Address</th>
                            <th>Contact No.</th>
                            <th>E-mail</th>
                            <th>Status</th>
                            <th>Remarks</th>
                            <th>Semester</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row = $result->fetch_array()) {
                            echo " <tr>
                        <td>$row[noano]</td>        
                        <td>$row[date]</td>
                        <td>$row[name]</td>
                        <td>$row[course]</td>
                        <td>$row[address]</td>
                        <td>$row[telephone] $row[cellphone]</td>
                        <td>$row[email]</td>
                        <td>$row[status]</td>                   
                        <td>$row[remarks]</td>  
                        <td>$row[semester]</td>
                        <td class=\"text-center\">     
                            <div class=\"btn-group\" role=\"group\">                  
                                <a href='editnoa.php?noano=$row[noano]'><span class=\"fas fa-edit mr-2\"></span></a>
                                <a href='javascript:gotoModal($row[noano]);'> <span class=\"fas fa-minus-circle\"></span> </a>
                            </div>                      
                        </td>                                      
                    </tr>";
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php
    include_once "../include/footer.php";
    ?>
</div>

<!--modal delete-->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="deletenoa.php" method="post">
                <div class="modal-body">
                    <p>Deleting this will also delete all record related to this student</p>
                    Re-enter your password to confirm delete:
                    <input required type="password" class="form-control" id="password" name="password">
                    <input type="hidden" id="id" name="id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-danger" name="delete" value="Delete">
                </div>
            </form>
        </div>
    </div>
</div>
<script src="../js/bootstrap.bundle.min.js" type="text/javascript"></script>
<script src="../js/sb-admin.min.js" type="text/javascript"></script>
<script>
    var row;
    $(document).ready(function () {

        var table = $('#myTable').DataTable({
            "lengthChange": false,
            buttons: [
                {
                    className: 'btn-success',
                    text: '<span class="fas fa-file"></span>&nbsp;Add to Notice of Admission',
                    action: function (e, dt, node, config) {
                        window.location = "admission.php";
                    }
                }
            ],
        });

        table.buttons().container()
            .appendTo($('.col-md-6:eq(0)', table.table().container()));
    })
    ;
</script>
</body>
</html>
