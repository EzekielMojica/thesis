<?php

require_once "../include/cn.php";
if (!isset($_SESSION)) {
    session_start();
    if (!isset($_GET['waiverno'])) {
     header('Location: studentorgs.php');
     exit;
 } else {
    $waiverno = test_input($_GET['waiverno']);
    $sql = "SELECT * FROM tblwaiver WHERE waiverno = '$waiverno'";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        header('Location: waiver.php');
    }
    $row = $result->fetch_array();
}
if (isset($_POST['editWaiver'])) {

  $orgname = test_input($_POST['orgname']);
  $number = test_input($_POST['number']);
  $date = test_input($_POST['date']);
  $event = test_input($_POST['event']);

  $sql = "UPDATE tblwaiver SET orgname='$orgname', number='$number', date = '$date',event = '$event' WHERE waiverno='".$_GET['waiverno']."'";
  $conn->query($sql)or die(mysqli_error($conn));

    //audit edit
    date_default_timezone_set('Asia/Manila');
    $user=$_SESSION["username"];
    $action = "Updated a waiver.";
    $dateandtime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
    $conn->query($sql) or die(mysqli_error($conn));

  header('Location: waiver.php');
}
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
                <span class="fas fa-user-plus"></span>
                Edit Waiver
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group row">
                        <label for="orgname" class="col-sm-2 col-form-label">Name of Organization:</label>
                        <div class="col">
                            <input value="<?php echo $row['orgname'] ?>" readonly name="orgname" required type="text" id="orgname"  class="form-control"
                            placeholder="Name of the Organization">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="number" class="col-sm-2 col-form-label">Number of Student:</label>
                        <div class="col">
                            <input value="<?php echo $row['number'] ?>" name="number" required type="text" id="number"  class="form-control"
                            placeholder="Number of Student">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date" class="col-sm-2 col-form-label">Date: </label>
                        <div class="col">
                            <input value="<?php echo $row['date'] ?>" name="date" required type="text" id="date"  class="form-control"
                            placeholder="Date">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="event" class="col-sm-2 col-form-label">Event: </label>
                        <div class="col">
                            <input value="<?php echo $row['event'] ?>" name="event" required type="text" id="event"  class="form-control"
                            placeholder="Event">
                        </div>
                    </div>                   
                    <div class="text-center">
                        <input name="editWaiver" type="submit" class="mr-5 btn btn-primary" value="Update">
                        <a href="waiver.php" class="ml-5 btn btn-secondary">Go Back</a>
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
