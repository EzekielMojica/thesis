<?php
require "../include/cn.php";
if (!isset($_SESSION)) {
    session_start();
    $sql = "SELECT * FROM tblevent";
    $result = $conn->query($sql);
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
                <span class="fas fa-calendar"></span>
                Events
            </div>
            <div class="card-body">
                <table id="myTable" class="table display table-responsive-md table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Event No.</th>
                        <th>Title</th>
                        <th>Venue</th>
                        <th>Description</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($row = $result->fetch_array()) {
                        echo " <tr>        
                        <td>$row[eventid]</td>
                        <td>$row[title]</td>
                        <td>$row[venue]</td>
                        <td>$row[description]</td>                     
                        <td>$row[start_event]</td>
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
    $(document).ready(function () {

        var table = $('#myTable').DataTable({
            "lengthChange": false,
            pageLength: 5,
            "order": [[ 4, "desc" ]],
            buttons: [
                {
                    className: 'btn-primary',
                    text: '<span class="fas fa-print"></span>&nbsp;Evaluate',
                    action: function (e, dt, node, config) {
                        var selected = table.row('.selected').data();
                        if (selected == null){
                            alert("Select event first to evaluate.");
                        }else
                        window.location = "evaluation.php?eventid=" + selected[0];
                    }
                },
                {
                    className: 'btn-success',
                    text: '<span class="fas fa-clipboard-check"></span>&nbsp;Evaluation Result',
                    action: function (e, dt, node, config) {
                        var selected = table.row('.selected').data();
                        if (selected == null){
                            alert("Select event first to show evaluation result.");
                        }else
                         window.location = "result.php?eventid=" + selected[0];
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

