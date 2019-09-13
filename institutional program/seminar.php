<?php
require "../include/cn.php";
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}
include_once "gui.php";
$sql = "SELECT * FROM tblseminar WHERE subunit = 'Institutional Program'";
$result = $conn->query($sql);
?>

<script>
    function gotoModal(id) {
        $('#delete').modal('toggle');
        $('#id').val(id);
    }
</script>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header">
                <span class="fas fa-sticky-note"></span>
                Seminars Attended
            </div>
            <div class="card-body">
                <table id="myTable" class="table display table-responsive table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Date</th>
                        <th>Sub-Unit</th>
                        <th>Sponsoring Unit/Key Person</th>
                        <th>Objectives</th>
                        <th>Title of Seminar</th>
                        <th>Venue/Location</th>
                        <th>Participants</th>
                        <th>Sponsoring Unit/Agency</th>
                        <th>Remarks</th>
                        <th>Semester</th>
                        <th>School Year</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($row = $result->fetch_array()) {
                        echo " <tr>
                            <td>$row[seminarno]</td>
                            <td>$row[date]</td> 
                            <td>$row[subunit]</td>
                            <td>$row[keyperson]</td>
                            <td>$row[objective]</td>
                            <td>$row[title]</td>
                            <td>$row[venue]</td>
                            <td>$row[participants]</td>
                            <td>$row[sponsoragency]</td>
                            <td>$row[remarks]</td>
                            <td>$row[semester]</td>
                            <td>$row[sy]</td>
                            <td class=\"text-center\">     
                            <a href='editseminar.php?seminarno=$row[seminarno]'><span class=\"fas fa-edit\"></span></a>
                            <a href='javascript:gotoModal($row[seminarno]);'> <span class=\"fas fa-minus-circle\"></span> </a>                     
                            </td>
                            </tr>";
                    }
                    ?>
                    </tbody>
                </table>
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
            <form action="deleteseminar.php" method="post">
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
            "order": [[ 0, "desc" ]],
            buttons: [
                {
                    className: 'btn-primary',
                    text: '<span class="fas fa-plus-circle"></span>&nbsp;Add Seminar',
                    action: function (e, dt, node, config) {
                        window.location = 'addseminar.php';
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
