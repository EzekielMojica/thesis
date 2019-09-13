<?php
include_once "gui.php";
require "../include/cn.php";
?>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
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
            <!--//2nd column-->
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header bg-warning text-center">
                        <span class="far fa-sticky-note"></span>
                        <b>Notes</b>
                    </div>
                    <ul id="note" class="list-group list-group-flush">
                        <?php
                        $sql = "SELECT * FROM tblnote ORDER  BY noteno DESC";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_array()){
                            echo "<li class=\"list-group-item\">" . $row['task'] . "<a class='float-right' href='removenote.php?noteno=". $row['noteno'] ."'>&times;</a></li>";
                        }
                        ?>
                        <li class="list-group-item"><input class="form-control-sm form-control" id="addnote"
                                                           type="text"></li>
                    </ul>
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
<script>
    $(document).ready(function () {
        $("#addnote").keypress(function (e) {
            if (e.which == 13) {
                var note = $("#addnote").val();
                $.ajax({
                    url: 'addnote.php',
                    data: 'task=' + note,
                    type: 'POST',
                    success: function (json) {
                        $("#note").prepend("<li class=\"list-group-item\">" + note + "<a class='float-right' href='removenote.php?noteno="+ json.id +"'>&times;</a></li>");
                        $("#addnote").val("");
                    }
                });
            }
        });

    });
</script>
</body>
</html>
