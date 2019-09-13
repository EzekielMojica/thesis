<?php
require "../include/cn.php";
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}
if (!isset($_GET['id'])){
    header('Location: boardinghouse.php');
    exit;
}else{

$id = test_input($_GET['id']);
    $sql = "SELECT tbladmission.*, tblnoa.course, tblboarder.* FROM tblboarder INNER JOIN tblnoa ON tblboarder.noano = tblnoa.noano INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno WHERE id='$id'";
    $result = $conn->query($sql);


$sql1 = "SELECT * FROM tblboardinghouse WHERE id = '$id'";
$result1 = $conn->query($sql1);
$row1 = $result1->fetch_array();
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
                <span class="fas fa-user"></span>
                  <?php echo $row1['bhousename'] ?> Boarders
            </div>
            <div class="card-body">
                <div class="container-fluid">
                <table id="myTable" class="table display table-responsive-md table-bordered table-striped">
                        <thead>      
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Address</th>
                            <th>Course</th>
                            <th>Contact Number</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row = $result->fetch_array()) {
                            echo " <tr>        
                        <td>$row[studnum]</td>
                        <td>$row[name]</td>
                        <td>$row[age]</td>
                        <td>$row[gender]</td>
                        <td>$row[address]</td>
                        <td>$row[course]</td>
                        <td>$row[cellphone]</td>             
                        <td class=\"text-center\">     
                        <a href='javascript:gotoModal($row[studnum]);'> <span class=\"fas fa-minus-circle\"></span> </a>                      
                        </td>
                        </tr>";
                        }
                        ?>

                        </tbody>
                    </table>
                     <div class="text-center">
                    <a href="boardinghouse.php" class="ml-5 btn btn-secondary">Go Back</a>
                </div>
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
            <form action="deleteboarder.php" method="post">
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
                    text: '<span class="fas fa-plus-circle"></span>&nbsp;Add Boarder',
                    action: function (e, dt, node, config) {
                        window.location = 'noalist5.php?id=<?php echo $id ?>';
                    }
                },
                {
                    className: 'btn-secondary',
                    text: '<span class="fas fa-print"></span>&nbsp;Print',
                    action: function (e, dt, node, config) {
                        window.location = 'printboarder.php?id=<?php echo $id ?>';
                    },
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