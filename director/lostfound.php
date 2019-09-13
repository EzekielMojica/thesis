<?php
require "../include/cn.php";
if (!isset($_SESSION)) {
    session_start();
    $sql = "SELECT * FROM tbllostandfound";
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

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header">
                <span class="fas fa-shopping-basket"></span>
                Lost and Found
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <table id="myTable" class="table display table-responsive table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Date Found</th>
                            <th>Found By</th>
                            <th>Time</th>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Remarks</th>
                            <th>Owner</th>
                            <th>Date Retrieve</th>
                            <th>Detail</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row = $result->fetch_array()) {
                            echo " <tr>
                        <td>$row[itemno]</td>        
                        <td>$row[datefound]</td>
                        <td>$row[foundby]</td>
                        <td>$row[time]</td>
                        <td>$row[itemname]</td>
                        <td>$row[quantity]</td>
                        <td>$row[remarks]</td>
                        <td>$row[owner]</td>                   
                        <td>$row[dateretrive]</td>  
                        <td>$row[detail]</td>
                        <td class=\"text-center\">     
                            <div class=\"btn-group\" role=\"group\">                  
                                <a href='editlostandfound.php?itemno=$row[itemno]'><span class=\"fas fa-edit mr-2\"></span></a>
                                <a href='javascript:gotoModal($row[itemno]);'> <span class=\"fas fa-minus-circle\"></span> </a>
                            </div>                      
                        </td>                                      
                    </tr>";
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                    <a href="lostandfound.php" class="ml-5 btn btn-secondary">Go Back</a>
                </div>
            </div>
        </div>
    </div>
    <?php
    include_once "../include/footer.php";
    ?>
</div>

<!--modal delete-->
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
            <form action="deletelostandfound.php" method="post">
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
        });

        table.buttons().container()
            .appendTo($('.col-md-6:eq(0)', table.table().container()));
    })
    ;
</script>
</body>
</html>
