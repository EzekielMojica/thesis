<?php
require_once "../include/cn.php";

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_GET['noano'])){
    $noano = test_input($_GET['noano']);
    $sql = "SELECT tbladmission.name, tblnoa.course FROM tblnoa INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno WHERE noano = '$noano'";
    $result = $conn->query($sql);
    $row = $result->fetch_array();
}else{
    header('Location: acceptanceslip.php');
}
if (isset($_POST['addAcceptance'])) {
    $date = test_input($_POST['date']);
    $reason = test_input($_POST['reason']);
    $semester = test_input($_POST['semester']);
    $sql = "INSERT INTO tblacceptanceslip(date, semester, reason, noano) 
                VALUES ('$date', '$semester', '$reason', '$noano')";
    $conn->query($sql) or die (mysqli_error($conn));

    //audit add
    date_default_timezone_set('Asia/Manila');
    $user = $_SESSION["username"];
    $action = "Added an acceptance slip.";
    $dateandtime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
    $conn->query($sql) or die();

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
                Add Acceptance Slip
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name:</label>
                        <div class="col">
                            <input name="name" required type="text" id="name" class="form-control"
                                   value="<?php echo $row['name']?>" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="course" class="col-sm-2 col-form-label">Course:</label>
                        <div class="col">
                            <input name="course" type="text" id="course" class="form-control" value="<?php echo $row['course']?>" disabled>
                        </div>
                        <label for="date" class="col-md-1 col-form-label">Date:</label>
                        <div class="col-md-2"><input name="date" required type="text" id="date"
                                                     value="<?php echo date("Y-m-d")?>"  class="form-control"
                                                     placeholder="YYYY-MM-DDD" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])">
                        </div>
                        <label for="semester" class="col-sm-2 col-form-label">Semester:</label>
                        <div class="col-md-2" id="semester">
                            <select class="form-control" name="semester">
                                <option value="1st">1st</option>
                                <option value="2nd">2nd</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="reason" class="col-md-2 col-form-label">Reason:</label>
                        <div class="col"><input name="reason" required type="text" id="reason"
                                                class="form-control"
                                                placeholder="Reason"></div>
                    </div>
                    <div class="text-center">
                        <input name="addAcceptance" type="submit" class="mr-5 btn btn-primary" value="Add">
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
