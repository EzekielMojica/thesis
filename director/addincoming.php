<?php
require_once "../include/cn.php";

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_POST['addIncoming'])) {
    $date = test_input($_POST['date']);
    $officename = test_input($_POST['officename']);
    $title = test_input($_POST['title']);
    $remarks=test_input($_POST['remarks']);
    $sql = "INSERT INTO tblincoming(date, officename, title, remarks) 
                VALUES ('$date', '$officename', '$title', '$remarks')";
    $conn->query($sql) or die (mysqli_error($conn));

    //audit add
    date_default_timezone_set('Asia/Manila');
    $user=$_SESSION["username"];
    $action = "Added an incoming letter/memo record.";
    $dateandtime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
    $conn->query($sql) or die(mysqli_error($conn));

    header('Location: incoming.php');
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
                <span class="fas fa-plus-square"></span>
                Add Letter/Memo
            </div>
            <div class="card-body">
                <form action="addincoming.php" method="post">
                    <div class="form-group row" id="name">
                        <label for="date" class="col-sm-2 col-form-label">Date:</label>
                        <div class="col"><input name="date" required type="text" id="date" value="<?php echo date("Y-m-d")?>"  class="form-control"
                                                placeholder="YYYY-MM-DDD" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])"></div>
                    </div>
                    <div class="form-group row">
                        <label for="officename" class="col-sm-2 col-form-label">Name of Office/Agency:</label>
                        <div class="col"><input name="officename" required type="text" id="officename"
                                                class="form-control"
                                                placeholder="Name of Office/Agency"></div>
                        <label for="title" class="col-sm-2 col-form-label">Title of letter:</label>
                        <div class="col"><input name="title" required type="text" id="title"
                                                class="form-control"
                                                placeholder="Title of letter"></div>
                    </div>
                    <div class="form-group row">
                        <label for="remarks" class="col-sm-2 col-form-label">Remarks:</label>
                        <div class="col"><input name="remarks" required type="text" id="remarks"
                                                class="form-control"
                                                placeholder="Remarks"></div>
                    </div>
                    <div class="text-center">
                        <input name="addIncoming" type="submit" class="mr-5 btn btn-primary" value="Add">
                        <input type="button" value="Go Back" onclick="window.history.back()"
                               class="ml-5 btn btn-secondary">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    include_once "../include/footer.php";
    ?>
</div>

<script src="../js/bootstrap.bundle.min.js" type="text/javascript"></script>
<script src="../js/sb-admin.min.js" type="text/javascript"></script>

</body>

</html>
