<?php
require_once "../include/cn.php";
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}
include_once "gui.php";

if (!isset($_GET['orgid'])){
    header('Location: studentorgs.php');
    exit;
}else{
$orgid = test_input($_GET['orgid']);
$sql = "SELECT tbladmission.name, tblnoa.course, tbladmission.address, tbladmission.cellphone, tbladmission.telephone, tblorgmember.* FROM tblorgmember INNER JOIN tblnoa ON tblorgmember.noano = tblnoa.noano INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno WHERE orgid = '$orgid'";
$result = $conn->query($sql) or die(mysqli_error($conn));

$_SESSION["orgid"] = $orgid;

$sql1 = "SELECT * FROM tblorgs WHERE orgid = '$orgid'";
$result1 = $conn->query($sql1);
$row1 = $result1->fetch_array();
}
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
                <?php echo $row1['name'] ?> Members
            </div>
            <div class="card-body">
                <table id="myTable" class="table display table-responsive-md table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Course</th>
                        <th>Address</th>
                        <th>Contact No.</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($row = $result->fetch_array()) {
                        echo " <tr>
                    <td>$row[name]</td>
                    <td>$row[position]</td>
                    <td>$row[course]</td>        
                    <td>$row[address]</td>
                    <td>$row[cellphone] / $row[telephone]</td>
                    <td class=\"text-center\">     
                        <a href='editorgmember.php?memberno=$row[memberno]&orgid=$_GET[orgid]'><span class=\"fas fa-edit\"></span></a>
                        <a href='javascript:gotoModal($row[memberno]);'> <span class=\"fas fa-minus-circle\"></span> </a>                      
                    </td>
                    </tr>";
                    }
                    ?>
                    </tbody>
                </table>
                <div class="text-center">
                    <a href="studentorgs.php" class="ml-5 btn btn-secondary">Go Back</a>
                </div>
            </div><br>
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
            <form action="deleteorgmember.php" method="post">
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
                    text: '<span class="fas fa-plus-circle"></span>&nbsp;Add Member',
                    action: function (e, dt, node, config) {
                        window.location = 'noalist.php?orgid=<?php echo $_GET['orgid']; ?>';
                    }
                }
            ]
           
        });
        table.buttons().container()
            .appendTo($('.col-md-6:eq(0)', table.table().container()));
    })
    ;
</script>
</body>
</html>
