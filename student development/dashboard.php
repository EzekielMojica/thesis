<?php
include_once "gui.php";
require "../include/cn.php";
$sql = "SELECT * FROM tblorgs ORDER BY orgid";
$result = $conn->query($sql);
?>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        <span class="fas fa-users"></span>
                        Student Organization
                    </div>
                    <div class="card-body">
                        <table id="myTable" class="table display table-responsive table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Organization Number</th>
                                <th>Type</th>
                                <th>Name of the Organization</th>
                                <th>Date</th>
                                <th>Academic Year</th>
                                <th>Adviser</th>
                                <th>President</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            while ($row = $result->fetch_array()) {
                                echo " <tr>
                    <td>$row[orgid]</td>
                    <td>$row[type]</td>        
                    <td>$row[name]</td>
                    <td>$row[date]</td>
                    <td>$row[academicyear]</td>
                    <td>$row[adviser]</td>";
                                $orgid = $row['orgid'];
                                $sql1 = "SELECT tbladmission.name FROM tblorgmember INNER JOIN tblnoa ON tblorgmember.noano = tblnoa.noano INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno WHERE position = 'President' AND orgid = '$orgid'";
                                $result1 = $conn->query($sql1);
                                if ($result1->num_rows == 0) {
                                    echo "<td>Please add a president</td>";
                                } else {
                                    $row1 = $result1->fetch_array();
                                    echo "<td>$row1[0]</td>";
                                }

                                echo "<td class=\"text-center\">     
                        <a href='editorg.php?orgid=$row[orgid]'><span class=\"fas fa-edit\"></span></a>
                        <a href='javascript:deleteOrg($row[orgid]);'><span class=\"fas fa-minus-circle\"></span></a>                      
                    </td>
                    </tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <br>
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
