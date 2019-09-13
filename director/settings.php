<?php
require_once "../include/cn.php";
$sql = "SELECT * FROM tblsettings ORDER BY id";
$result = $conn->query($sql);
if (!isset($_SESSION)) {
    session_start();
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
                Accounts
            </div>
            <div class="card-body">
                <table id="myTable" class="table display table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($row = $result->fetch_array()) {
                        echo " <tr>        
                        <td>$row[id]</td>
                        <td>$row[name]</td>
                        <td>$row[position]</td>                
                        <td class=\"text-center\">                     
                                <a href='editsettings.php?id=$row[id]'><span class=\"fas fa-edit\"></span></a>    ";
                        echo"
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
<script src="../js/bootstrap.bundle.min.js" type="text/javascript"></script>
<script src="../js/sb-admin.min.js" type="text/javascript"></script>
<script>
    var row;
    $(document).ready(function () {
        var table = $('#myTable').DataTable({
            "lengthChange": false,
            pageLength: 6,
        });
        table.buttons().container()
            .appendTo($('.col-md-6:eq(0)', table.table().container()));
    })
    ;
</script>

</body>
</html>
