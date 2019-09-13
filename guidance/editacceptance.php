<?php
require_once "../include/cn.php";

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_GET['acceptanceno'])) {
    header('Location: acceptanceslip.php');
    exit;
} else {
    $acceptanceno = test_input($_GET['acceptanceno']);
    $sql = "SELECT tbladmission.name, tblnoa.course, tblacceptanceslip.* FROM tblacceptanceslip INNER JOIN tblnoa ON tblacceptanceslip.noano = tblnoa.noano INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno WHERE acceptanceno = '$acceptanceno'";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        header('Location: acceptanceslip.php');
        exit;
    }
    $row = $result->fetch_array();
}
if (isset($_POST['editAcceptance'])) {
    $date = test_input($_POST['date']);
    $reason = test_input($_POST['reason']);
    $semester = test_input($_POST['semester']);
    $sql = "UPDATE tblacceptanceslip SET date='$date', semester = '$semester', reason= '$reason' WHERE acceptanceno='".$_GET['acceptanceno']."'";
    $conn->query($sql) or die (mysqli_error($conn));

    //audit edit
    date_default_timezone_set('Asia/Manila');
    $user=$_SESSION["username"];
    $action = "Updated an acceptance slip record.";
    $dateandtime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
    $conn->query($sql) or die(mysqli_error($conn));

    header('Location: acceptanceslip.php');
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
                Edit Acceptance Slip
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group row" id="name">
                        <label for="name" class="col-md-2 col-form-label">Name:</label>
                        <div class="col">
                            <input name="name" required type="text" id="name" class="form-control"
                                   value="<?php echo $row['name']?>" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="course" class="col-md-2 col-form-label">Course:</label>
                        <div class="col">
                            <input name="course" type="text" id="course" class="form-control" value="<?php echo $row['course']?>" disabled>
                        </div>
                        <label for="date" class="col-md-1 col-form-label">Date:</label>
                        <div class="col-md-2"><input value="<?php echo $row['date'] ?>" name="date" required type="text" id="date"
                                                class="form-control"
                                                placeholder="YYYY-MM-DDD" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])"></div>
                        <label for="semester" class="col-sm-2 col-form-label">Semester:</label>
                        <?php
                        if ($row['semester'] == '1st'){
                            echo "<div class=\"col-md-2\" id=\"semester\">
                            <select class=\"form-control\" name=\"semester\">
                                <option value=\"1st\">1st</option>
                                <option value=\"2nd\">2nd</option>
                            </select>
                        </div>";
                        }else{
                            echo "<div class=\"col-md-2\" id=\"semester\">
                            <select class=\"form-control\" name=\"semester\">
                                <option value=\"2nd\">2nd</option>
                                <option value=\"1st\">1st</option>
                            </select>
                        </div>";
                        }
                        ?>

                    </div>
                    <div class="form-group row">
                        <label for="reason" class="col-md-2 col-form-label">Reason:</label>
                        <div class="col"><input value="<?php echo $row['reason'] ?>" name="reason" required type="text" id="reason"
                                                class="form-control"
                                                placeholder="Reason"></div>
                    </div>
                    <div class="text-center">
                        <input name="editAcceptance" type="submit" class="mr-5 btn btn-primary" value="Edit">
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
