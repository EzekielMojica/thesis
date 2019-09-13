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
    header('Location: scholarship.php');
}
if (isset($_POST['addScholarship'])) {

    $type = test_input($_POST['type']);
    $semester = test_input($_POST['semester']);
    
    $sql = "INSERT INTO tblscholarship VALUES (null, '$type', '$semester', '$noano')";
    $result = $conn->query($sql) or die(mysqli_error($conn));

    //audit add
    date_default_timezone_set('Asia/Manila');
    $user=$_SESSION["username"];
    $action = "Added a record in scholarship.";
    $dateandtime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
    $conn->query($sql) or die(mysqli_error($conn));

    header('Location: scholarship.php');
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
                Add Scholar
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name:</label>
                        <div class="col"><input value="<?php echo $row['name']?>" disabled name="name" required type="text" id="name"
                            class="form-control"
                            placeholder="Name"></div>
                            <label for="course" class="col-sm-2 col-form-label">Course:</label>
                            <div class="col"><input value="<?php echo $row['course']?>" disabled name="course" required type="text" id="course"
                                class="form-control"
                                placeholder="Course"></div>
                            </div>
                            <div class="form-group row">
                                <label for="type" class="col-sm-2 col-form-label">Type:</label>
                                <div class="col"><input name="type" required type="text" id="type"
                                    class="form-control"
                                    placeholder="Type"></div>
                                    <label for="semester" class="col-sm-2 col-form-label">Semester:</label>
                                    <div class="col"><input name="semester" required type="text" id="semester"
                                        class="form-control"
                                        placeholder="Semester"></div>
                                    </div>
                                    <div class="text-center">
                                        <input name="addScholarship" type="submit" class="mr-5 btn btn-primary" value="Add">
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
