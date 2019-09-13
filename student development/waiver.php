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
$sql = "SELECT * FROM tblwaiver ORDER BY waiverno";
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
                Waiver
            </div>
            <div class="card-body">
                <table id="myTable" class="table display table-responsive-md table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Waiver No.</th>
                            <th>Name of Organization</th>
                            <th>No. of Waiver</th>
                            <th>Date</th>
                            <th>Event</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $result->fetch_array()) {
                            echo " <tr>
                            <td>$row[waiverno]</td>
                            <td>$row[orgname]</td> 
                            <td>$row[number]</td>
                            <td>$row[date]</td>
                            <td>$row[event]</td>
                            <td class=\"text-center\">     
                            <a href='editwaiver.php?waiverno=$row[waiverno]'><span class=\"fas fa-edit\"></span></a>
                            <a href='javascript:gotoModal($row[waiverno]);'> <span class=\"fas fa-minus-circle\"></span> </a>                         
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
            <form action="deletewaiver.php" method="post">
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
                text: '<span class="fas fa-plus-circle"></span>&nbsp;Add Waiver',
                action: function (e, dt, node, config) {
                    window.location = 'addwaiver.php';
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
