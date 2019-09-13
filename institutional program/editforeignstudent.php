<?php

require_once "../include/cn.php";
if (!isset($_SESSION)) {
    session_start();
    if (!isset($_GET['studnum'])) {
       header('Location: foreignstudent.php');
        exit;
    } else {
        $studNum = test_input($_GET['studnum']);
        $sql = "SELECT tbladmission.*, tblnoa.course, tblforeignstudent.* FROM tblforeignstudent INNER JOIN tblnoa ON tblforeignstudent.noano = tblnoa.noano INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno WHERE studNum = '$studNum'";
        $result = $conn->query($sql);
        if ($result->num_rows == 0) {
            header('Location: foreignstudent.php');
            exit;
        }
        $row = $result->fetch_array();
    }
    if (isset($_POST['editForeignStudent'])) {
        $nationality = test_input($_POST['nationality']);
        $sql = "UPDATE tblforeignstudent SET nationality='$nationality' WHERE studnum='".$_GET['studnum']."'";
        $conn->query($sql);

        //audit edit
        date_default_timezone_set('Asia/Manila');
        $user=$_SESSION["username"];
        $action = "Updated a record in foreign student.";
        $dateandtime = date("Y-m-d H:i:s");
        $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
        $conn->query($sql) or die(mysqli_error($conn));

        echo "<script>alert('Foreign student record successfully updated!');
        window.location='foreignstudent.php';
        </script>";
        //header('Location: foreignstudent.php');
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
                Edit Foreign Student
            </div>
            <div class="card-body">
                <form action="editforeignstudent.php?studnum=<?php echo $_GET['studnum']; ?>" method="post">
                    <div class="form-group row">
                        <label for="nationality" class="col-sm-2 col-form-label">Nationality:</label>
                        <div class="col">
                            <input value="<?php echo $row['nationality']?>" required name="nationality" type="text" id="nat" class="form-control"
                                   placeholder="Nationality"></div>
                    </div>
                    <div class="form-group row" id="name">
                        <label for="name" class="col-sm-2 col-form-label">Name:</label>
                        <div class="col" id="firstName">
                            <input value="<?php echo $row['name']?>" disabled name="name" required type="text" id="name"
                                   class="form-control"
                                   placeholder="Name"></div>
                    </div>
                    <div class="form-group row">
                        <label for="age" class="col-sm-2 col-form-label">Age:</label>
                        <div class="col">
                            <input value="<?php echo $row['age']?>" disabled required name="age" type="text" id="age" class="form-control"
                                   placeholder="Age"></div>
                        <label for="gender" class="col-sm-2 col-form-label">Gender:</label>
                        <div class="col">
                            <input value="<?php echo $row['gender']?>" disabled required name="gender" type="text" id="gender" class="form-control"
                                   placeholder="Gender"></div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label">Address:</label>
                        <div class="col">
                            <input value="<?php echo $row['address']?>" disabled required name="address" type="text" id="address" class="form-control"
                                   placeholder="Address"></div>
                    </div>
                    <div class="form-group row">
                        <label for="course" class="col-sm-2 col-form-label">Course:</label>
                        <div class="col">
                            <input value="<?php echo $row['course']?>" disabled required name="course" type="text" id="course" class="form-control"
                                   placeholder="Course"></div>
                    </div>
                    <div class="form-group row">
                        <label for="contactnum" class="col-sm-2 col-form-label">Contact Number:</label>
                        <div class="col">
                            <input value="<?php echo $row['cellphone']?>" disabled required name="contactnum" type="text" id="contactnum" class="form-control"
                                   placeholder="Contact Number"></div>
                    </div>
                    <div class="text-center">
                        <input name="editForeignStudent" type="submit" class="mr-5 btn btn-primary" value="Done">
                        <a href="foreignstudent.php" class="ml-5 btn btn-secondary">Go Back</a>
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
