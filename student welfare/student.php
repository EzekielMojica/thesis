<?php
require_once "../include/cn.php";
$sql = "SELECT tbladmission.name, tblnoa.course, tblstudent.* FROM tblstudent INNER JOIN tblnoa ON tblstudent.noano = tblnoa.noano INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno";
$result = $conn->query($sql);
?>
<script>
    function gotoModal(id) {
        $('#delete').modal('toggle');
        $('#id').val(id);
    }
</script>

<div class="card mb-3">
    <div class="card-header">
        <span class="fas fa-users"></span>
        Student Directory
    </div>
    <div class="card-body">
        <table id="myTable" class="table display table-responsive table-bordered table-striped">
            <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Course</th>
                <th>Religion</th>
                <th>Mobile No.</th>
                <th>FB Account</th>
                <th>E-Mail Address</th>
                <th>Home Address</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            while ($row = $result->fetch_array()) {
                echo " <tr>  
                        <td>$row[studno]</td>      
                        <td>$row[name]</td>
                        <td>$row[course]</td>
                        <td>$row[religion]</td>                     
                        <td>$row[contactno]</td>
                        <td>$row[facebook]</td>
                        <td>$row[email]</td>
                        <td>$row[barangay] $row[municipality], $row[city_province]</td>
                        <td class=\"text-center\">                     
                                <a href='editstudent.php?studno=$row[studno]'><span class=\"fas fa-edit\"></span></a>
                                <a href='javascript:gotoModal($row[studno]);'> <span class=\"fas fa-minus-circle\"></span> </a>                 
                        </td>
                    </tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
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
            <form action="deletestudent.php" method="post">
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
            pageLength: 5,
            "infoCallback": function (settings, start, end, max, total, pre) {
                return '<a href="studentnumber.php"><b>Total Number of Students:&nbsp;' + total + '</b></a>';
            },
            buttons: [
                {
                    className: 'btn-primary',
                    text: '<span class="fas fa-plus-circle"></span>&nbsp;Add Student',
                    action: function (e, dt, node, config) {
                        window.location = 'noalist.php';
                    },
                },
                {
                    className: 'btn-secondary',
                    text: '<span class="fas fa-print"></span>&nbsp;Print',
                    action: function (e, dt, node, config) {
                        window.location = 'printstudent.php';
                    },
                }

            ],
        });
        table.buttons().container()
            .appendTo($('.col-md-6:eq(0)', table.table().container()));
    })
    ;
</script>
