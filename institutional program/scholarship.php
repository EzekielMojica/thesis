<?php
require "../include/cn.php";
if (!isset($_SESSION)) {
    session_start();
    $sql = "SELECT tbladmission.name, tblnoa.course, tblscholarship.* FROM tblscholarship INNER JOIN tblnoa ON tblscholarship.noano = tblnoa.noano INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno";
    $result = $conn->query($sql) or die(mysqli_error($conn));
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
<script>
    function deleteScholarship(password,id) {
        if (password == null || password == "") {
            alert("Please enter your password!")
        } else {
            window.location.href = 'deletescholarship.php?scholarnum=' + id + '&password=' + password;
        }
    }
</script>

<div class="content-wrapper">
    <div class="container-fluid">
       <div class="card mb-3">
        <div class="card-header">
            <span class="fas fa-users"></span>
            Scholarship
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <table id="myTable" class="table display table-responsive-md table-bordered table-striped">
                    <thead>      
                        <tr>
                            <th>Scholar No.</th>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Type</th>
                            <th>Semester</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $result->fetch_array()) {
                            echo " <tr>        
                            <td>$row[scholarnum]</td>
                            <td>$row[name]</td>                     
                            <td>$row[course]</td>
                            <td>$row[type]</td>
                            <td>$row[semester]</td>
                            <td class=\"text-center\">     
                            <a href='editscholarship.php?scholarnum=$row[scholarnum]'><span class=\"fas fa-edit\"></span></a>
                            <a href='javascript:gotoModal($row[scholarnum]);'> <span class=\"fas fa-minus-circle\"></span> </a>                      
                            </td>
                            </tr>";
                        }
                        ?>

                    </tbody>
                </table>
            </div>
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
            <div class="modal-body">
                Re-enter your password to confirm delete:
                <input type="password" class="form-control" id="password">
                <input type="hidden" id="id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger" href='javascript:deleteScholarship(document.getElementById("password").value,document.getElementById("id").value)'>Delete</a>
            </div>
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
                text: '<span class="fas fa-plus-circle"></span>&nbsp;Add Scholar',
                action: function (e, dt, node, config) {
                    window.location = 'noalist.php';
                }
            },
            {
                className: 'btn-success',
                text: '<span class="fas fa-file"></span>&nbsp;Summary',
                action: function (e, dt, node, config) {
                    window.location = 'summary.php';
                }
            }
            ]
        });
        table.buttons().container()
        .appendTo($('.col-md-6:eq(0)', table.table().container()));
    })
    ;
</script>
</body>
</html>