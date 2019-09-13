<?php

require_once "../include/cn.php";
if (!isset($_SESSION)) {
    session_start();
    if (!isset($_GET['studno'])) {
        header('Location: students.php');
        exit;
    } else {
        $studno = test_input($_GET['studno']);
        $sql = "SELECT tbladmission.name, tblnoa.course, tblstudent.* FROM tblstudent INNER JOIN tblnoa ON tblstudent.noano = tblnoa.noano INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno WHERE studno = '$studno'";
        $result = $conn->query($sql);
        if ($result->num_rows == 0) {
            header('Location: students.php');
            exit;
        }
        $row = $result->fetch_array();
    }
    if (isset($_POST['editStudent'])) {
        $barangay = test_input($_POST['barangay']);
        $municipality = test_input($_POST['municipality']);
        $city_province = test_input($_POST['city_province']);
        $religion = test_input($_POST['religion']);
        $email = test_input($_POST['email']);
        $contactNo = test_input($_POST['contactNo']);
        $facebook = test_input($_POST['facebook']);
        $sql = "UPDATE tblstudent SET   barangay='$barangay', municipality='$municipality', city_province='$city_province', religion='$religion', email='$email', contactno='$contactNo', facebook='$facebook' WHERE studno='" . $_GET['studno'] . "'";
        $conn->query($sql);

        //audit edit
        date_default_timezone_set('Asia/Manila');
        $user = $_SESSION["username"];
        $action = "Updated a student record in student directory.";
        $dateandtime = date("Y-m-d H:i:s");
        $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
        $conn->query($sql) or die(mysqli_error($conn));

        header('Location: students.php');
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
                <span class="fas fa-edit"></span>
                Edit Student's Info
            </div>
            <div class="card-body">
                <form action="editstudent.php?studno=<?php echo $_GET['studno']; ?>" method="post">
                    <div class="form-group row" id="name">
                        <label for="name" class="col-sm-2 col-form-label">Name:</label>
                        <div class="col">
                            <input name="name" required type="text" id="name" class="form-control"
                                   value="<?php echo $row['name'] ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="brgy" class="col-sm-2 col-form-label">Home Address:</label>
                        <div class="col"><input required value="<?php echo $row['barangay'] ?>" name="barangay"
                                                type="text"
                                                id="brgy" class="form-control"
                                                placeholder="Barangay"></div>
                        <div class="col"><input required value="<?php echo $row['municipality'] ?>" name="municipality"
                                                type="text" class="form-control"
                                                placeholder="Municipality"></div>
                        <div class="col"><input required value="<?php echo $row['city_province'] ?>"
                                                name="city_province"
                                                type="text" class="form-control"
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
                        <div class="col"><input required value="<?php echo $row['religion'] ?>" name="religion"
                                                type="text"
                                                id="religion" class="form-control"
                                                placeholder="Religion"></div>
                        <label for="email" class="col-sm-2 col-form-label">E-mail Address:</label>
                        <div class="col"><input required value="<?php echo $row['email'] ?>" name="email" type="email"
                                                id="email"
                                                class="form-control"
                                                placeholder="Email"></div>

                    </div>
                    <div class="form-group row">
                        <label for="contactNo" class="col-sm-2 col-form-label">Contact Number:</label>
                        <div class="col"><input pattern="\d{11}" required value="<?php echo $row['contactno'] ?>"
                                                name="contactNo" type="text"
                                                id="contactNo" class="form-control"
                                                placeholder="11-Digit Number"></div>
                        <label for="fbAccount" class="col-sm-2 col-form-label">Facebook Account:</label>
                        <div class="col-sm-4"><input required value="<?php echo $row['facebook'] ?>" name="facebook"
                                                     type="text"
                                                     id="fbAccount" class="form-control"
                                                     placeholder="Name or E-mail"></div>
                    </div>
                    <div class="text-center">
                        <input name="editStudent" type="submit" class="mr-5 btn btn-primary" value="Done">
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
