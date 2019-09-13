<?php

require_once "../include/cn.php";
if (!isset($_SESSION)) {
    session_start();
    $id=$_SESSION['id'];
    if (!isset($_GET['studnum'])) {
       header('Location: boarder.php');
        exit;
    } else {
        $studNum = test_input($_GET['studnum']);
        $sql = "SELECT * FROM tblboarder WHERE studnum = '$studNum'";
        $result = $conn->query($sql);
        if ($result->num_rows == 0) {
            header('Location: boarder.php?id=$id');
            exit;
        }
        $row = $result->fetch_array();
    }
    if (isset($_POST['editBoarder'])) {
        $studentNumber = test_input($_POST['studentNumber']);
        $firstName = test_input($_POST['firstName']);
        $middleName = test_input($_POST['middleName']);
        $lastName = test_input($_POST['lastName']);
        $age = test_input($_POST['age']);
        $gender = test_input($_POST['gender']);
        $address = test_input($_POST['address']);
        $course = test_input($_POST['course']);  
        $contactNum = test_input($_POST['contactnum']);
        $sql = "UPDATE tblboarder SET studnum='$studentNumber', firstname='$firstName', middlename='$middleName', lastname='$lastName', age='$age', gender='$gender', address='$address', course='$course', contactnum='$contactNum' WHERE studnum='".$_GET['studnum']."'";
        $conn->query($sql);

        //audit edit
        date_default_timezone_set('Asia/Manila');
        $user=$_SESSION["username"];
        $action = "Updated a record in boarder.";
        $dateandtime = date("Y-m-d H:i:s");
        $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
        $conn->query($sql) or die(mysqli_error($conn));

        echo "<script>alert('Boarder record successfully updated!');
        window.location='boarder.php?id=$id';
        </script>";
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
                Edit Boarder
            </div>
            <div class="card-body">
                <form action="editboarder.php?studnum=<?php echo $_GET['studnum']; ?>"  method="post">
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
                        <input name="editBoarder" type="submit" class="mr-5 btn btn-primary" value="Done">
                        <a href="boarder.php?id=<?php echo $_SESSION["id"] ?>" class="ml-5 btn btn-secondary">Go Back</a>
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
