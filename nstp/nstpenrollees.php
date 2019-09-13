<?php
require_once "../include/cn.php";
$sql = "SELECT tbladmission.*, tblnoa.course, tblnstpenrollees.* FROM tblnstpenrollees INNER JOIN tblnoa ON tblnstpenrollees.noano = tblnoa.noano INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno";
$result = $conn->query($sql);
if (!isset($_SESSION)) {
    session_start();
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
                NSTP Enrollees
            </div>
            <div class="card-body" style="border-top: 10px solid white; padding: 0px;">
                <div>
                    <table id="myTable" class="table display table-responsive table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Serial No.</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Course/Program</th>
                            <th>Gender</th>
                            <th>Birthdate</th>                   
                            <th>Provincial Address</th>                            
                            <th>Contact Number</th>
                            <th>E-mail</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row = $result->fetch_array()) {
                            echo " <tr>        
                        <td>$row[nstp]</td>
                        <td>$row[serialno]</td>
                        <td>$row[category]</td>
                        <td>$row[name]</td>
                        <td>$row[course]</td>
                        <td>$row[gender]</td>                     
                        <td>$row[dateofbirth]</td>                        
                        <td>$row[paddress]</td>
                        <td>$row[cellphone]</td>
                        <td>$row[email]</td>
                        <td class=\"text-center\">                     
                        <a href='editnstp.php?nstp=$row[nstp]'><span class=\"fas fa-edit\"></span></a>
                        <a href='javascript:gotoModal($row[nstp]);'> <span class=\"fas fa-minus-circle\"></span> </a>                    
                        </td>                
                        </td>
                        </tr>";
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
                <br>
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
            <form action="deletenstp.php" method="post">
                <div class="modal-body">
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
                    className: 'btn-primary',
                    text: '<span class="fas fa-plus-circle"></span>&nbsp;Add NSTP Enrollees',
                    action: function (e, dt, node, config) {
                        window.location = 'noalist.php';
                    }
                },
                {
                    className: 'btn-secondary',
                    text: '<span class="fas fa-print"></span>&nbsp;Certificate',
                    action: function (e, dt, node, config) {
                       var selected = table.row('.selected').data();
                       if (selected==null){
                           alert("Please select a student first to print certificate.")
                       }
                       window.location = "certificate.php?nstp="+ selected[0] +"&name="+ selected[3] + "&date="+ moment().format('MMMM DD, YYYY') + "&program="+ selected[2] + "";
                    }
                },
                {
                    className: 'btn-secondary',
                    text: '<span class="fas fa-print"></span>&nbsp;Print',
                    action: function (e, dt, node, config) {
                        window.location = 'printnstp.php';
                    }
                }
            ],
            select: true
        });
        table.buttons().container()
            .appendTo($('.col-md-6:eq(0)', table.table().container()));
    })
    ;
</script>
