<?php
require_once "../include/cn.php";
$sql = "SELECT * FROM tblorgs";
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
        Student Organization
    </div>
    <div class="card-body table-responsive">
            <table id="myTable" class="table display table-bordered table-striped">
                <thead>
                <tr>
                    <th>No.</th>
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
                    if ($result1->num_rows == 0){
                        echo "<td>Please add a president</td>";
                    }else{
                        $row1 = $result1->fetch_array();
                    echo "<td>$row1[0]</td>";
                    }
                    echo "<td class=\"text-center\">
                        <a href='editorg.php?orgid=$row[orgid]'><span class=\"fas fa-edit\"></span></a>
                        <a href='javascript:gotoModal($row[orgid]);'> <span class=\"fas fa-minus-circle\"></span> </a>                     
                    </td>
                    </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div><br>
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
            <form action="deleteorg.php" method="post">
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
                    text: '<span class="fas fa-plus-circle"></span>&nbsp;Add Student Org',
                    action: function (e, dt, node, config) {
                        window.location = 'addorg.php';
                    }
                },
                {
                    className: 'btn-success',
                    text: '<span class="fas fa-clipboard-check"></span>&nbsp;View Members',
                    action: function (e, dt, node, config) {
                        var selected = table.row('.selected').data();
                        if (selected == null){
                            alert("Select org first to view members");
                        }else
                        window.location = "orgmember.php?orgid=" + selected[0];
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