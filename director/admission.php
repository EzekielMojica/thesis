<?php
require "../include/cn.php";
if (!isset($_SESSION)) {
    session_start();
    $sql = "SELECT * FROM tbladmission WHERE NOT EXISTS (SELECT * FROM tblnoa WHERE tblnoa.admissionno = tbladmission.admissionno)";
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
    function deleteAdmission(password,id) {
        if (password == null || password == "") {
            alert("Please enter your password!")
        } else {
            window.location.href = 'deleteadmission.php?admissionno=' + id + '&password=' + password;
        }
    }
</script>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header">
                <span class="fas fa-plus-circle"></span>
                Select Student
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <table id="myTable" class="table display table-responsive table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Admission No.</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Address</th>
                            <th>Date of Birth</th>
                            <th>Telephone</th>
                            <th>Cellphone</th>
                            <th>Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row = $result->fetch_array()) {
                            echo " <tr>
                        <td>$row[admissionno]</td>        
                        <td>$row[name]</td>
                        <td>$row[age]</td>
                        <td>$row[gender]</td>
                        <td>$row[address]</td>
                        <td>$row[dateofbirth]</td>
                        <td>$row[telephone]</td>
                        <td>$row[cellphone]</td>
                        <td>$row[email]</td>                                        
                    </tr>";
                        }
                        ?>

                        </tbody>
                    </table>
                    <div class="text-center">
                        <a href="noa.php" class="ml-5 btn btn-secondary">Go Back</a>
                    </div>
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
                            window.location = "addnoa.php?admissionno=" + selected[0];
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
