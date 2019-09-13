<?php
require_once "../include/cn.php";
if (!isset($_SESSION)) {
    session_start();
    $sql = "SELECT tbladmission.name, tblnoa.course, tblstudentoffence.* FROM tblstudentoffence INNER JOIN tblnoa ON tblstudentoffence.noano = tblnoa.noano INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno";
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
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        <span class="fas fa-ban"></span>
                        Student Offences
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <table id="myTable" class="table display table-responsive table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Offence No.</th>
                                    <th>Name</th>
                                    <th>Course</th>
                                    <th>Item Confiscated</th>
                                    <th>Date Confiscated</th>
                                    <th>Semester</th>
                                    <th>Offence Commited</th>
                                    <th>Penalty</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                while ($row = $result->fetch_array()) {
                                    echo " <tr>        
                         <td>$row[offenceno]</td>
                        <td>$row[name]</td>
                        <td>$row[course]</td>
                        <td>$row[itemconfiscated]</td>                     
                        <td>$row[dateconfiscated]</td>
                        <td>$row[semester]</td>
                        <td>$row[offencecommitted]</td>
                        <td>$row[penalty]</td>
                        <td>$row[status]</td>
                        <td class=\"text-center\">     
                            <div class=\"btn-group\" role=\"group\">                  
                                <a href='editoffence.php?offenceno=$row[offenceno]'><span class=\"fas fa-edit\"></span></a>
                                <a href='#'><span class=\"fas fa-minus-circle\"></span></a>   
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
            <!--//2nd column-->
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <span class="fas fa-calendar-alt"></span>
                        Calendar of Activities
                    </div>
                    <div class="card-body">
                        <?php
                        include "../include/calendar.php";
                        ?>
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
            pageLength: 5,
        });
        table.buttons().container()
            .appendTo($('.col-md-6:eq(0)', table.table().container()));
    })
    ;
</script>
</body>
</html>
