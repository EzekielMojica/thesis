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
    $barangay = test_input($_POST['barangay']);
    $municipality = test_input($_POST['municipality']);
    $city_province = test_input($_POST['city_province']);
    $religion = test_input($_POST['religion']);
    $email = test_input($_POST['email']);
    $contactNo = test_input($_POST['contactNo']);
    $facebook = test_input($_POST['facebook']);
    $sql = "INSERT INTO tblstudent VALUES (null, '$barangay', '$municipality', '$city_province', '$religion', '$email', '$contactNo', '$facebook', '$noano')";
    $result = $conn->query($sql) or die(mysqli_error($conn));

    //audit add
    date_default_timezone_set('Asia/Manila');
    $user=$_SESSION["username"];
    $action = "Added a student in student directory.";
    $dateandtime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
    $result = $conn->query($sql) or die(mysqli_error($conn));

    header('Location: students.php');

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
                        <label for="brgy" class="col-sm-2 col-form-label">Home Address:</label>
                        <div class="col"><input required name="barangay" type="text" id="brgy" class="form-control"
                                                placeholder="Barangay"></div>
                        <div class="col"><input required name="municipality" type="text" class="form-control"
                                                placeholder="Municipality"></div>
                        <div class="col"><input required name="city_province" type="text" class="form-control"
                                                placeholder="City/Province"></div>
                    </div>
                    <div class="form-group row">
                        <label for="course" class="col-sm-2 col-form-label">Course:</label>
                        <div class="col">
                            <input name="course" type="text" id="course" class="form-control" value="<?php echo $row['course']?>" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="religion" class="col-sm-2 col-form-label">Religion:</label>
                        <div class="col"><input required name="religion" type="text" id="religion" class="form-control"
                                                placeholder="Religion"></div>
                        <label for="email" class="col-sm-2 col-form-label">E-mail Address:</label>
                        <div class="col"><input required name="email" type="email" id="email" class="form-control"
                                                placeholder="Email"></div>

                    </div>
                    <div class="form-group row">
                        <label for="contactNo" class="col-sm-2 col-form-label">Contact Number:</label>
                        <div class="col"><input pattern="\d{11}" required name="contactNo" type="text" id="contactNo" class="form-control"
                                                placeholder="11-Digit Number"></div>
                        <label for="fbAccount" class="col-sm-2 col-form-label">Facebook Account:</label>
                        <div class="col-sm-4"><input required name="facebook" type="text" id="fbAccount" class="form-control"
                                                     placeholder="Name or E-mail"></div>
                    </div>
                    <div class="text-center">
                        <input name="addStudent" type="submit" class="mr-5 btn btn-primary" value="Add">
                        <a href="noalist.php" class="ml-5 btn btn-secondary">Go Back</a>
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
