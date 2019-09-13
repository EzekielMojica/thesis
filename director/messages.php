<?php
require_once "../include/cn.php";
$sql = "SELECT * FROM tblmessage ORDER BY messageno DESC";
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
                <span class="fas fa-list"></span>
                Audit Trail of Transaction
            </div>
            <div class="card-body">
                <table id="myTable" class="table display table-bordered">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Message</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($row = $result->fetch_array()) {
                        echo " <tr>        
                        <td>$row[messageno]</td>
                        <td>$row[name]</td>
                        <td>$row[email]</td>
                        <td>$row[message]</td>                     
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
            pageLength: 5,
            "order": [[ 0, "desc" ]]
        });
        table.buttons().container()
            .appendTo($('.col-md-6:eq(0)', table.table().container()));
    })
    ;
</script>

</body>
</html>
