<?php

require_once "../include/cn.php";
if (!isset($_SESSION)) {
    session_start();
    if (!isset($_GET['studnum'])) {
       header('Location: pwd.php');
        exit;
    } else {
        $studNum = test_input($_GET['studnum']);
        $sql = "SELECT tbladmission.*, tblnoa.course, tblpwd.* FROM tblpwd INNER JOIN tblnoa ON tblpwd.noano = tblnoa.noano INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno WHERE studNum = '$studNum'";
        $result = $conn->query($sql) or die(mysqli_error($conn));
        if ($result->num_rows == 0) {
            header('Location: pwd.php');
            exit;
        }
        $row = $result->fetch_array();
    }
    if (isset($_POST['editPWD'])) {
        $type = test_input($_POST['type']);
        $sql = "UPDATE tblpwd SET type='$type' WHERE studnum='".$_GET['studnum']."'";
        $conn->query($sql);

        //audit edit
        date_default_timezone_set('Asia/Manila');
        $user=$_SESSION["username"];
        $action = "Updated a record in PWD student.";
        $dateandtime = date("Y-m-d H:i:s");
        $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
        $conn->query($sql) or die(mysqli_error($conn));

        echo "<script>alert('PWD record successfully updated!');
        window.location='pwd.php';
        </script>";
        // header('Location: pwd.php');
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
                Edit PWD
            </div>
            <div class="card-body">
                <form action="editpwd.php?studnum=<?php echo $_GET['studnum']; ?>" onsubmit="return validate_pwd()" method="post">
                    <div class="form-group row" id="name">
                        <label for="name" class="col-sm-2 col-form-label">Name:</label>
                        <div class="col" id="name">
                            <input value="<?php echo $row['name']?>" disabled name="name" required type="text" id="name"
                                   class="form-control"
                                   placeholder="Name"></div>
                    </div>
                    <div class="form-group row">
                        <label for="gender" class="col-sm-2 col-form-label">Gender:</label>
                        <div class="col">
                            <input value="<?php echo $row['gender']?>" disabled required name="gender" type="text" id="gender" class="form-control"
                                   placeholder="Gender"></div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label">Address:</label>
                        <div class="col">
                            <input required value="<?php echo $row['address']?>" disabled name="address" type="text" id="address" class="form-control"
                                   placeholder="Address"></div>
                    </div>
                    <div class="form-group row">
                        <label for="contactnum" class="col-sm-2 col-form-label">Contact Number:</label>
                        <div class="col">
                            <input pattern="\d{11}" value="<?php echo $row['cellphone']?>" disabled required name="contactnum" type="text" id="contactnum" class="form-control"
                                   placeholder="Contact Number"></div>
                    </div>
                    <div class="form-group row">
                        <label for="course" class="col-sm-2 col-form-label">Course:</label>
                        <div class="col">
                            <input required value="<?php echo $row['course']?>" disabled name="course" type="text" id="course" class="form-control"
                                   placeholder="Course"></div>
                    </div>
                    <div class="form-group row">
                        <label for="type" class="col-sm-2 col-form-label">Type:</label>
                        <div class="col">
                            <input value="<?php echo $row['type'] ?>" name="type" type="text" id="type" class="form-control"
                                        placeholder="Type"></div>
                    </div>       
                    <div class="text-center">
                        <input name="editPWD" type="submit" class="mr-5 btn btn-primary" value="Done">
                        <a href="pwd.php" class="ml-5 btn btn-secondary">Go Back</a>
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
