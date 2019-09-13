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
<script>
    function deleteNOA(password,id) {
        if (password == null || password == "") {
            alert("Please enter your password!")
        } else {
            window.location.href = 'deletenoa.php?noano=' + id + '&password=' + password;
        }
    }
</script>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header">
                <span class="fas fa-plus-circle"></span>
                Select a Student
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <table id="myTable" class="table display table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Address</th>
                            <th>Contact No.</th>
                            <th>Semester</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row = $result->fetch_array()) {
                            echo " <tr>
                        <td>$row[noano]</td>        
                        <td>$row[name]</td>
                        <td>$row[course]</td>
                        <td>$row[address]</td>
                        <td>$row[telephone] / $row[cellphone]</td>
                        <td>$row[semester]</td>                                     
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
            <div class="modal-body">
                Re-enter your password to confirm delete:
                <input type="password" class="form-control" id="password">
                <input type="hidden" id="id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger" href='javascript:deleteNOA(document.getElementById("password").value,document.getElementById("id").value)'>Delete</a>
            </div>
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
            "select": true,
            buttons: [
                {
                    className: 'btn-success',
                    text: '<span class="fas fa-arrow-alt-circle-right"></span>&nbsp;Done',
                    action: function (e, dt, node, config) {
                        var selected = table.row('.selected').data();
                        if (selected == null)
                            alert("Please select a student");
                        else
                            window.location = "addcasereport.php?noano=" + selected[0];
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
