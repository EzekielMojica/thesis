<?php
include_once "include/header.php";
require_once "include/cn.php";
$sql = "SELECT * FROM tbldownload ORDER BY date DESC ";
$result = $conn->query($sql);
?>

<script>
    function gotoModal(id) {
        $('#delete').modal('toggle');
        $('#id').val(id);
    }
</script>


<div class="wrapper container-fluid">
    <div class="container">
        <table class="table table-striped mx-auto table-bordered mt-3 mb-3">
            <thead>
            <tr>
                <th>Date</th>
                <th>File Name</th>
                <th>File</th>
                <?php
                if (isset($_SESSION['logid'])){
                    if ($_SESSION['logid'] == 1){
                        echo "<th>Action</th>";
                    }
                }
                ?>
            </tr>
            </thead>
            <tbody>
            <?php
            while ($row = $result->fetch_array()) {
                echo "
                    <tr>
                        <td>$row[date]</td>
                        <td>$row[filename]</td>
                        <td><a href='$row[path]'>Download</a></td>                   
                    ";
                if (isset($_SESSION['logid'])){
                    if ($_SESSION['logid'] == 1){
                       echo "<td class=\"text-center\">     
                            <div class=\"btn-group\" role=\"group\">                  
                                <a href='director/editdownload.php?downloadno=$row[downloadno]'><span class=\"fas fa-edit mr-2\"></span></a>
                                <a href='javascript:gotoModal($row[downloadno]);'> <span class=\"fas fa-minus-circle\"></span> </a>
                            </div>                      
                        </td>   ";
                    }
                }
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>

    </div>
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
            <form action="deletedownloads.php" method="post">
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

<?php
include_once "include/footer.php";
?>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>
</body>

</html>
