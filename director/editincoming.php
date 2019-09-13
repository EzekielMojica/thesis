<?php
require_once "../include/cn.php";

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_GET['letterno'])) {
    header('Location: incoming.php');
    exit;
} else {
    $letterno = test_input($_GET['letterno']);
    $sql = "SELECT * FROM tblincoming WHERE letterno = '$letterno'";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        header('Location: incoming.php');
        exit;
    }
    $row = $result->fetch_array();
}
if (isset($_POST['editIncoming'])) {
    $date = test_input($_POST['date']);
    $officename = test_input($_POST['officename']);
    $title = test_input($_POST['title']);
    $remarks=test_input($_POST['remarks']);
    $sql = "UPDATE tblincoming SET date = '$date', officename ='$officename', title='$title', remarks= '$remarks' WHERE letterno='".$_GET['letterno']."'";
    $conn->query($sql) or die (mysqli_error($conn));

    //audit edit
    date_default_timezone_set('Asia/Manila');
    $user=$_SESSION["username"];
    $action = "Updated a Letter/Memo record.";
    $dateandtime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
    $conn->query($sql) or die(mysqli_error($conn));;

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
                Add Letter
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group row" id="name">
                        <label for="date" class="col-sm-2 col-form-label">Date:</label>
                        <div class="col"><input value="<?php echo $row['date'] ?>" name="date" required type="text" class="form-control"
                                                placeholder="Date"></div>
                    </div>
                    <div class="form-group row">
                        <label for="officename" class="col-sm-2 col-form-label">Name of Office/Agency:</label>
                        <div class="col"><input value="<?php echo $row['officename'] ?>" name="officename" required type="text" id="officename"
                                                class="form-control"
                                                placeholder="Name of Office/Agency"></div>
                        <label for="title" class="col-sm-2 col-form-label">Title of letter:</label>
                        <div class="col"><input value="<?php echo $row['title'] ?>" name="title" required type="text" id="title"
                                                class="form-control"
                                                placeholder="Title of letter"></div>
                    </div>
                    <div class="form-group row">
                        <label for="remarks" class="col-sm-2 col-form-label">Remarks:</label>
                        <div class="col"><input value="<?php echo $row['remarks'] ?>" name="remarks" required type="text" id="remarks"
                                                class="form-control"
                                                placeholder="Remarks"></div>
                    </div>
                    <div class="text-center">
                        <input name="editIncoming" type="submit" class="mr-5 btn btn-primary" value="Update">
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
