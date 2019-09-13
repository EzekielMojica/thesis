<?php
require_once "../include/cn.php";
$sql = "SELECT * FROM tbllogin ORDER BY id";
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
                        <th>Username</th>
                        <th>Password</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($row = $result->fetch_array()) {
                        echo " <tr>        
                        <td>$row[id]</td>
                        <td>$row[name]</td>
                        <td>$row[username]</td>
                        <td>$row[password]</td>                     
                        <td class=\"text-center\">                     
                                <a href='editaccount.php?id=$row[id]'><span class=\"fas fa-edit\"></span></a>    ";
                        switch ($row['id']){
                            case 1:
                               echo "<a href=../director/dashboard.php><span class='fas fa-arrow-alt-circle-right'></span></a>";
                               break;
                            case 2:
                                echo "<a href=../student%20welfare/dashboard.php><span class='fas fa-arrow-alt-circle-right'></span></a>";
                                break;
                            case 3:
                                echo "<a href=../guidance/dashboard.php><span class='fas fa-arrow-alt-circle-right'></span></a>";
                                break;
                            case 4:
                                echo "<a href=../student%20development/dashboard.php><span class='fas fa-arrow-alt-circle-right'></span></a>";
                                break;
                            case 5:
                                echo "<a href=../institutional%20program/dashboard.php><span class='fas fa-arrow-alt-circle-right'></span></a>";
                                break;
                            case 6:
                                echo "<a href=../nstp/dashboard.php><span class='fas fa-arrow-alt-circle-right'></span></a>";
                                break;
                        }

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
