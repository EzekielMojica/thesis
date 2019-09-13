<?php
require_once "../include/cn.php";
if (!isset($_SESSION)) {
    session_start();
    $sql = "SELECT tblnoa.*, tbladmission.* FROM tblnoa INNER  JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno";
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
                <span class="fas fa-users"></span>
                Good Moral
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
    $(document).ready(function () {

        var table = $('#myTable').DataTable({
            "lengthChange": false,
            buttons: [
                {
                    className: 'btn-secondary',
                    text: '<span class="fas fa-print"></span>&nbsp;Print Good Moral',
                    action: function (e, dt, node, config) {
                       var selected = table.row('.selected').data();
                       if (selected == null){
                           alert("Please select a student")
                       }else{
                           window.location = "download.php?noano="+ selected[0] +"&name="+ selected[2] +"&date="+ moment().format('MMMM DD, YYYY') +"";
                       }
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
</body>
</html>
