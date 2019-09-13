<?php

require_once "../include/cn.php";
if (!isset($_SESSION)) {
    session_start();
    if (!isset($_GET['accomplishedno'])) {
       header('Location: accomplishedactivity.php');
       exit;
   } else {
    $accomplishedno = test_input($_GET['accomplishedno']);
    $sql = "SELECT * FROM tblaccomplished WHERE accomplishedno = '$accomplishedno'";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        header('Location: accomplishedactivity.php');
        exit;
    }
    $row = $result->fetch_array();
}
if (isset($_POST['editAccomplished'])) {

  $orgname = test_input($_POST['orgname']);
  $proposedate = test_input($_POST['date']);
  $activity = test_input($_POST['activity']);
  $name = test_input($_POST['name']);
  $date = test_input($_POST['date']);
  $participants = test_input($_POST['participants']);
  $remarks = test_input($_POST['remarks']);

  $sql = "UPDATE tblaccomplished SET orgname='$orgname', proposedate = '$proposedate', activity = '$activity', name = '$name', date = '$date', participants='$participants', remarks = '$remarks' WHERE accomplishedno='".$_GET['accomplishedno']."'";
  $conn->query($sql)or die(mysqli_error($conn));

    //audit edit
    date_default_timezone_set('Asia/Manila');
    $user=$_SESSION["username"];
    $action = "Updated an accomplished activity record.";
    $dateandtime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
    $conn->query($sql) or die(mysqli_error($conn));

  header('Location: accomplishedactivity.php');
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
                Edit Accomplished Activity
            </div>
            <div class="card-body">
                <form method="post">

                    <div class="form-group row">
                        <label for="orgname" class="col-sm-2 col-form-label">Name of the Organization:</label>
                        <div class="col">
                            <input value="<?php echo $row['orgname'] ?>" name="orgname" required type="text" id="orgname"  class="form-control"
                            placeholder="Name of the Organization">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date" class="col-sm-2 col-form-label">Proposed Date:</label>
                        <div class="col">
                            <input value="<?php echo $row['proposedate'] ?>" name="proposedate" required type="text" id="date"  class="form-control"
                            placeholder="Date">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="activity" class="col-sm-2 col-form-label">Activity: </label>
                        <div class="col">
                            <input value="<?php echo $row['activity'] ?>" name="activity" required type="text" id="activity"  class="form-control"
                            placeholder="Activity">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name: </label>
                        <div class="col">
                            <input value="<?php echo $row['name'] ?>" name="name" required type="text" id="name"  class="form-control"
                            placeholder="Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date" class="col-sm-2 col-form-label">Date</label>
                        <div class="col">
                            <input value="<?php echo $row['date'] ?>" name="date" required type="text" id="date" class="form-control"
                            placeholder="Date"></div>
                        </div>
                        <div class="form-group row">
                            <label for="president" class="col-sm-2 col-form-label">Participants:</label>
                            <div class="col">
                                <input value="<?php echo $row['participants'] ?>" name="participants" required type="text" id="participants" class="form-control"
                                placeholder="Participants"></div>
                            </div>    
                            <div class="form-group row">
                                <label for="remarks" class="col-sm-2 col-form-label">Remarks:</label>
                                <div class="col">
                                    <input value="<?php echo $row['remarks'] ?>" name="remarks" required type="text" id="remarks" class="form-control"
                                    placeholder="Remarks"></div>
                                </div>                   
                                <div class="text-center">
                                    <input name="editAccomplished" type="submit" class="mr-5 btn btn-primary" value="Update">
                                    <a href="accomplishedactivity.php" class="ml-5 btn btn-secondary">Go Back</a>
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
