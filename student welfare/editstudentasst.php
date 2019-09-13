<?php

require_once "../include/cn.php";
if (!isset($_SESSION)) {
    session_start();
    if (!isset($_GET['assistantno'])) {
       // header('Location: studentasst.php');
        exit;
    } else {
        $assistantno = test_input($_GET['assistantno']);
        $sql = "SELECT tbladmission.name, tblnoa.course, tblstudentasst.* FROM tblstudentasst INNER JOIN tblnoa ON tblstudentasst.noano = tblnoa.noano INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno WHERE assistantno = '$assistantno'";
        $result = $conn->query($sql);
        if ($result->num_rows == 0) {
            header('Location: studentasst.php');
            exit;
        }
        $row = $result->fetch_array();
    }
    if (isset($_POST['editStudent'])) {

        $office = test_input($_POST['office']);
        $startdate = test_input(($_POST['startdate']));

        $supervisor = test_input($_POST['supervisor']);
        $resigndate = test_input($_POST['resigndate']);
        if ($resigndate <= date("Y-m-d")){
            $status = "Inactive";
        }else{
            $status = "Working";
        }
        $sql = "UPDATE tblstudentasst SET   office='$office', startdate='$startdate', status='$status', supervisor='$supervisor', resigndate='$resigndate'WHERE assistantno='" . $_GET['assistantno'] . "'";
        $conn->query($sql);

        //audit edit
        date_default_timezone_set('Asia/Manila');
        $user = $_SESSION["username"];
        $action = "Updated a student record in student directory.";
        $dateandtime = date("Y-m-d H:i:s");
        $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
        $conn->query($sql) or die(mysqli_error($conn));

        header('Location: studentasst.php');
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
                Edit Student Assistant
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
                        <div class="col"><input value="<?php echo $row['office'] ?>" required name="office" type="text" id="office" class="form-control"
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
                            <input name="startdate" required type="text" id="date" value="<?php echo $row['startdate'] ?>"  class="form-control"
                                   placeholder="YYYY-MM-DDD" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rdate" class="col-sm-2 col-form-label">Resign Date:</label>
                        <div class="col">
                            <input name="resigndate" type="text" id="rdate" value="<?php echo date("Y-m-d")?>"  class="form-control"
                                   placeholder="YYYY-MM-DDD" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="supervisor" class="col-sm-2 col-form-label">Supervisor:</label>
                        <div class="col"><input required name="supervisor" value="<?php echo $row['supervisor'] ?>" type="text" id="supervisor" class="form-control"
                                                placeholder="Supervisor"></div>
                    </div>
                    <div class="text-center">
                        <input name="editStudent" type="submit" class="mr-5 btn btn-primary" value="Done">
                        <a href="studentasst.php" class="ml-5 btn btn-secondary">Go Back</a>
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
