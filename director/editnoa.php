<?php
require_once "../include/cn.php";


if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_GET['noano'])) {
    header('Location: casereport.php');
    exit;
} else {
    $noano = test_input($_GET['noano']);
    $sql = "SELECT tbladmission.name, tblnoa.* FROM tblnoa INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno WHERE noano = '$noano'";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        header('Location: noa.php');
        exit;
    }
    $row = $result->fetch_array();
}
if (isset($_POST['editNoa'])) {

    $date = test_input($_POST['date']);
    $course = test_input($_POST['course']);
    $status = test_input($_POST['status']);
    $remarks = test_input($_POST['remarks']);
    $semester = test_input($_POST['semester']);

    $sql = "UPDATE tblnoa SET date = '$date', course = '$course', status = '$status', remarks = '$remarks', semester = '$semester' WHERE noano = '$noano'";
    $result = $conn->query($sql) or die(mysqli_error($conn));

    //audit add
    date_default_timezone_set('Asia/Manila');
    $user=$_SESSION["username"];
    $action = "Added a Notice Of Admission record.";
    $dateandtime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
    $conn->query($sql) or die(mysqli_error($conn));
    echo "<script>alert('NOA successfully added!');window.location.href='noa.php'</script>";
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
                Add Notice of Admission
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
                        <label for="date" class="col-sm-2 col-form-label">Date:</label>
                        <div class="col">
                            <input name="date" required type="text" id="date" value="<?php echo date("Y-m-d")?>"  class="form-control"
                                   placeholder="YYYY-MM-DDD" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="course" class="col-sm-2 col-form-label">Course:</label>
                        <div class="col">
                            <input value="<?php echo $row['course']?>" name="course" required type="text" id="course" class="form-control"
                                   placeholder="Course">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-2 col-form-label">Status: </label>
                        <div class="col">
                            <select required name="status" id="status" class="form-control">
                                <?php
                                switch ($row['status']){
                                    case "Enrolled":
                                        echo "<optgroup>
                                    <option value=\"Enrolled\">Enrolled</option>
                                    <option value=\"Not Enrolled\">Not Enrolled</option>
                                </optgroup>";
                                        break;
                                    case "Not Enrolled":
                                        echo "<optgroup>
                                    <option value=\"Not Enrolled\">Not Enrolled</option>
                                    <option value=\"Enrolled\">Enrolled</option>
                                </optgroup>";
                                        break;
                                }
                                ?>

                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="remarks" class="col-sm-2 col-form-label">Remarks: </label>
                        <div class="col">
                            <input value="<?php echo $row['remarks']?>" name="remarks" required type="text" id="remarks" class="form-control"
                                   placeholder="Remarks">
                        </div>
                    </div>
                    <div class="form-group row" id="name">
                        <label for="semester" class="col-sm-2 col-form-label">Semester:</label>
                        <div class="col-md-2" id="semester">
                            <select class="form-control" name="semester">
                                <?php
                                switch ($row['semester']){
                                    case "1st":
                                        echo "<optgroup>
                                     <option value=\"1st\">1st</option>
                                <option value=\"2nd\">2nd</option>>";
                                        break;
                                    case "2nd":
                                        echo "<optgroup>
                                      <option value=\"2nd\">2nd</option>
                                <option value=\"1st\">1st</option>";
                                        break;
                                }
                                ?>

                            </select>
                        </div>
                    </div>
                    <div class="text-center">
                        <input name="editNoa" type="submit" class="mr-5 btn btn-primary" value="Add">
                        <a href="noa.php" class="ml-5 btn btn-secondary">Go Back</a>
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
