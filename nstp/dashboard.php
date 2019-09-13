<?php
include_once "gui.php";
require "../include/cn.php";
$sql = "SELECT tbladmission.*, tblnoa.course, tblnstpenrollees.* FROM tblnstpenrollees INNER JOIN tblnoa ON tblnstpenrollees.noano = tblnoa.noano INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno";
$result = $conn->query($sql);
?>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
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
                                    <th>E-mail</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Birthdate</th>
                                    <th>CYS</th>
                                    <th>Provisional Address</th>
                                    <th>Category</th>
                                    <th>Contact Number</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                while ($row = $result->fetch_array()) {
                                    echo " <tr>        
                        <td>$row[nstp]</td>
                        <td>$row[serialno]</td>
                        <td>$row[email]</td>
                        <td>$row[name]</td>
                        <td>$row[gender]</td>                     
                        <td>$row[dateofbirth]</td>
                        <td>$row[course]</td>
                        <td>$row[paddress]</td>
                         <td>$row[category]</td>
                        <td>$row[cellphone]</td>
                        <td class=\"text-center\">                     
                            <div class=\"btn-group\" role=\"group\">                  
                                <a href='editnstp.php?studnum=$row[nstp]'  ><span class=\"fas fa-edit\"></span></a>
                                <a href='#'><span class=\"fas fa-minus-circle\"></span></a>     
                            </div>                  
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

</body>
</html>
