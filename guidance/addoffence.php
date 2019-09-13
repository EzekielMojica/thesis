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
    header('Location: studentoffence.php');
}
if (isset($_POST['addOffence'])) {

    $itemConfiscated = test_input($_POST['itemConfiscated']);
    $dateConfiscated = test_input($_POST['dateConfiscated']);
    $offenceCommited = test_input($_POST['offenceCommited']);
    $penalty = test_input($_POST['penalty']);
    $status = "Pending";
    $semester = test_input($_POST['semester']);
    $sql = "INSERT INTO tblstudentoffence(itemconfiscated, dateconfiscated, semester, offencecommitted, penalty, status, noano) 
                VALUES ('$itemConfiscated', '$dateConfiscated', '$semester', '$offenceCommited', '$penalty', '$status', '$noano')";
    $conn->query($sql) or die (mysqli_error($conn));

    //audit add
    date_default_timezone_set('Asia/Manila');
    $user=$_SESSION["username"];
    $action = "Added a student offence.";
    $dateandtime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
    $conn->query($sql) or die(mysqli_error($conn));

    header('Location: studentoffence.php');
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
                Add Student Offense
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
                        <label for="itemConfiscated" class="col-sm-2 col-form-label">Item Confiscated:</label>
                        <div class="col"><input name="itemConfiscated" required type="text" id="itemConfiscated"
                                                class="form-control"
                                                placeholder="Item Confiscated"></div>
                        <label for="dateConfiscated" class="col-sm-2 col-form-label">Date Confiscated:</label>
                        <div class="col"><input name="dateConfiscated" required type="text" id="dateConfiscated" value="<?php echo date("Y-m-d")?>"  class="form-control"
                                                 placeholder="YYYY-MM-DDD" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])"></div>
                    </div>
                    <div class="form-group row">
                        <label for="offenceCommited" class="col-sm-2 col-form-label">Offence Commited:</label>
                        <div class="col"><input name="offenceCommited" required type="text" id="offenceCommited"
                                                class="form-control"
                                                placeholder="Offence Commited"></div>
                        <label for="penalty" class="col-sm-2 col-form-label">Penalty:</label>
                        <div class="col"><input name="penalty" required type="text" id="penalty" class="form-control"
                                                placeholder="Penalty"></div>
                    </div>
                    <div class="form-group row">
                        <label for="course" class="col-sm-2 col-form-label">Course:</label>
                        <div class="col">
                             <input name="course" type="text" id="course" class="form-control" value="<?php echo $row['course']?>" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="semester" class="col-sm-2 col-form-label">Semester:</label>
                        <div class="col-md-4" id="semester">
                            <select class="form-control" name="semester">
                                <option value="1st">1st</option>
                                <option value="2nd">2nd</option>
                            </select>
                        </div>
                    </div>
                    <div class="text-center">
                        <input name="addOffence" type="submit" class="mr-5 btn btn-primary" value="Add">
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
