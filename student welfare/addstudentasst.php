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
    header('Location: students.php');
}
if (isset($_POST['addStudent'])) {

    $office = test_input($_POST['office']);
    $startdate = test_input(($_POST['startdate']));
    $status = "Working";
    $supervisor = test_input($_POST['supervisor']);

    $sql = "INSERT INTO tblstudentasst VALUES (null, '$office', '$startdate', '$status', '$supervisor', null, '$noano')";
    $result = $conn->query($sql) or die(mysqli_error($conn));

    //audit add
    date_default_timezone_set('Asia/Manila');
    $user=$_SESSION["username"];
    $action = "Added a student in student directory.";
    $dateandtime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
    $result = $conn->query($sql) or die(mysqli_error($conn));

    header('Location: studentasst.php');

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
                Add Student
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group row" id="name">
                        <label for="name" class="col-sm-2 col-form-label">Name:</label>
                        <div class="col">
                            <input name="name" required type="text" id="name" class="form-control"
                                   value="<?php echo $row['name']?>" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="office" class="col-sm-2 col-form-label">Office:</label>
                        <div class="col"><input required name="office" type="text" id="office" class="form-control"
                                                placeholder="Office"></div>
                    </div>
                    <div class="form-group row">
                        <label for="course" class="col-sm-2 col-form-label">Course:</label>
                        <div class="col">
                            <input name="course" type="text" id="course" class="form-control" value="<?php echo $row['course']?>" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date" class="col-sm-2 col-form-label">Start Date:</label>
                        <div class="col">
                            <input name="startdate" required type="text" id="date" value="<?php echo date("Y-m-d")?>"  class="form-control"
                                   placeholder="YYYY-MM-DDD" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="supervisor" class="col-sm-2 col-form-label">Supervisor:</label>
                        <div class="col"><input required name="supervisor" type="text" id="supervisor" class="form-control"
                                                placeholder="Supervisor"></div>
                    </div>
                    <div class="text-center">
                        <input name="addStudent" type="submit" class="mr-5 btn btn-primary" value="Add">
                        <a href="students.php" class="ml-5 btn btn-secondary">Go Back</a>
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
