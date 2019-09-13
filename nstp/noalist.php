<?php
require "../include/cn.php";
if (!isset($_SESSION)) {
    session_start();
    $sql = "SELECT tblnoa.*, tbladmission.name, tbladmission.address, tbladmission.telephone, tbladmission.cellphone, tbladmission.email FROM tblnoa INNER  JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno WHERE NOT EXISTS (SELECT * FROM tblnstpenrollees WHERE tblnstpenrollees.noano = tblnoa.noano)";
    $result = $conn->query($sql);
}
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}
include_once "gui.php";
?>


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
                            window.location = "addnstp.php?noano=" + selected[0];
                    }
                },

            ],

        });

        table.buttons().container()
            .appendTo($('.col-md-6:eq(0)', table.table().container()));
    })
    ;
</script>
</body>
</html>
