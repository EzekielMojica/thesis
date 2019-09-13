<?php
require "../include/cn.php";
if (!isset($_SESSION)) {
    session_start();
    $sql = "SELECT * FROM tblspecialstudent ORDER BY studnum";
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
            <div class="card-header"  style="background-color:black">
                <span class="fas fa-users" style="color: white"></span>
                <span style="color:white">Special Student</span>
            </div>
            <div class="card-body">
                <div class="container-fluid" >
                    <table id="myTable" class="table display table-responsive table-bordered table-striped">
                        <thead>      
                        <tr>
                            <th>Student Number</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Address</th>
                            <th>Type</th>                          
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
                        <td>$row[firstname]  $row[middlename] $row[lastname]</td>
                        <td>$row[age]</td>                     
                        <td>$row[gender]</td>
                        <td>$row[address]</td>
                        <td>$row[type]</td>
                        <td>$row[course]</td>
                        <td>$row[contactnum]</td>                        
                        <td class=\"text-center\">                     
                            <div class=\"btn-group\" role=\"group\">                  
                                <button type=\"button\" id=\"editSpecialStudent\" class=\"px-0 btn btn-link\" onclick=\"\"><span class=\"fas fa-edit\"></span></button>
                                <button type=\"button\" class=\"px-0 btn btn-link\" onclick=\"\"><span class=\"fas fa-minus-circle\"></span></button>   
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
                    text: '<span class="fas fa-plus-circle"></span>&nbsp;Add Special Student',
                    action: function (e, dt, node, config) {
                        window.location = 'addspecialstudent.php';
                    }
                }
            ],
        });

        $('#myTable tbody').on('click', '#editSpecialStudent', function () {
            var tr = $(this).parents('tr').closest('tr');
            row = table.row(tr).data();
            window.location = 'editSpecialStudent.php?studnum=' + row[0];
        });
        table.buttons().container()
            .appendTo($('.col-md-6:eq(0)', table.table().container()));
    })
    ;
</script>
</body>
</html>