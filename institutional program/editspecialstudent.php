<?php

require_once "../include/cn.php";
if (!isset($_SESSION)) {
    session_start();
    if (!isset($_GET['studnum'])) {
       header('Location: specialstudent.php');
        exit;
    } else {
        $studNum = test_input($_GET['studnum']);
        $sql = "SELECT * FROM tblspecialstudent WHERE studnum = '$studNum'";
        $result = $conn->query($sql);
        if ($result->num_rows == 0) {
            header('Location: specialstudent.php');
            exit;
        }
        $row = $result->fetch_array();
    }
    if (isset($_POST['editSpecialStudent'])) {
        $studentNumber = test_input($_POST['studentNumber']);
        $firstName = test_input($_POST['firstName']);
        $middleName = test_input($_POST['middleName']);
        $lastName = test_input($_POST['lastName']);
        $age = test_input($_POST['age']);
        $gender = test_input($_POST['gender']);
        $address = test_input($_POST['address']);
        $type = test_input($_POST['type']);
        $course = test_input($_POST['course']);  
        $contactNum = test_input($_POST['contactnum']);
        $sql = "UPDATE tblspecialstudent SET studnum='$studentNumber', firstname='$firstName', middlename='$middleName', lastname='$lastName', age='$age', gender='$gender', address='$address', type='$type', course='$course', contactnum='$contactNum' WHERE studnum='".$_GET['studnum']."'";
        $conn->query($sql);

        //audit edit
        date_default_timezone_set('Asia/Manila');
        $user=$_SESSION["username"];
        $action = "Updated a record in special student.";
        $dateandtime = date("Y-m-d H:i:s");
        $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
        $conn->query($sql) or die();

        echo "<script>alert('Info successfully updated!');
        window.location='specialstudent.php';
        </script>";
        //header('Location: specialstudent.php');
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
                Edit Special Student
            </div>
            <div class="card-body">
                <form action="editspecialstudent.php?studnum=<?php echo $_GET['studnum']; ?>" onsubmit="return validate_specialstudent()" method="post">
                    <div class="form-group row">
                        <label for="studentNumber" class="col-sm-2 col-form-label">Student Number:</label>
                        <div class="col">
                            <input value="<?php echo $row['studnum'] ?>" name="studentNumber" type="text" id="studnum" class="form-control"
                                        placeholder="Student Number"></div>
                    </div>
                    <div class="form-group row" id="name">
                        <label for="name" class="col-sm-2 col-form-label">Name:</label>
                        <div class="col" id="firstName">
                            <input value="<?php echo $row['firstname'] ?>" name="firstName" type="text" class="form-control" id="fn"
                                        placeholder="First Name"></div>
                        <div class="col" id="middleName">
                            <input value="<?php echo $row['middlename'] ?>" name="middleName" type="text" class="form-control" id="mn"
                                        placeholder="Middle Name"></div>
                        <div class="col" id="lastName">
                            <input value="<?php echo $row['lastname'] ?>" name="lastName" type="text" class="form-control" id="ln"
                                        placeholder="Last Name"></div>
                    </div>
                    <div class="form-group row">
                        <label for="age" class="col-sm-2 col-form-label">Age:</label>
                        <div class="col">
                            <input value="<?php echo $row['age'] ?>" name="age" type="text" id="age" class="form-control"
                                        placeholder="Age"></div>
                        <label for="gender" class="col-sm-2 col-form-label">Gender:</label>
                        <div class="col">
                            <input value="<?php echo $row['gender'] ?>" name="gender" type="text" id="gender" class="form-control"
                                        placeholder="Gender"></div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label">Address:</label>
                        <div class="col">
                            <input value="<?php echo $row['address'] ?>" name="address" type="text" id="address" class="form-control" 
                                        placeholder="Address"></div>
                        <label for="type" class="col-sm-2 col-form-label">Type:</label>
                        <div class="col">
                            <input value="<?php echo $row['type'] ?>" name="type" type="text" id="type" class="form-control" 
                                        placeholder="Type"></div>                        
                    </div>
                    <div class="form-group row">
                        <label for="course" class="col-sm-2 col-form-label">Course:</label>
                        <div class="col">
                            <input value="<?php echo $row['course'] ?>" name="course" type="text" id="course" class="form-control"
                                        placeholder="Course"></div>
                    </div>
                    <div class="form-group row">
                        <label for="contactnum" class="col-sm-2 col-form-label">Contact Number:</label>
                        <div class="col">
                            <input value="<?php echo $row['contactnum'] ?>" name="contactnum" type="text" id="contactnum" class="form-control"
                                        placeholder="Contact Number"></div>
                    </div>       
                    <div class="text-center">
                        <input name="editSpecialStudent" type="submit" class="mr-5 btn btn-primary" value="Done">
                        <a href="specialstudent.php" class="ml-5 btn btn-secondary">Go Back</a>
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
