<?php

require_once "../include/cn.php";
if (!isset($_SESSION)) {
    session_start();
    if (!isset($_GET['studnum'])) {
       header('Location: indigenous.php');
        exit;
    } else {
        $studNum = test_input($_GET['studnum']);
        $sql = "SELECT tbladmission.*, tblnoa.course, tblindigenous.* FROM tblindigenous INNER JOIN tblnoa ON tblindigenous.noano = tblnoa.noano INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno WHERE studNum = '$studNum'";
        $result = $conn->query($sql);
        if ($result->num_rows == 0) {
            header('Location: indigenous.php');
            exit;
        }
        $row = $result->fetch_array();
    }
    if (isset($_POST['editIndigenous'])) {
        $indigenousGroup = test_input($_POST['indigenousGroup']);
        $sql = "UPDATE tblindigenous SET indigenousGroup='$indigenousGroup' WHERE studnum='".$_GET['studnum']."'";
        $conn->query($sql);

        //audit edit
        date_default_timezone_set('Asia/Manila');
        $user=$_SESSION["username"];
        $action = "Updated a record in indigenous.";
        $dateandtime = date("Y-m-d H:i:s");
        $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
        $conn->query($sql) or die(mysqli_error($conn));

        header('Location: indigenous.php');
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
                Edit Indigenous Student
            </div>
            <div class="card-body">
                <form action="editindigenous.php?studnum=<?php echo $_GET['studnum']; ?>" onsubmit="return validate_indigenous()" method="post">
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
                            <input value="<?php echo $row['age']?>" disabled name="age" type="text" id="age" class="form-control"
                                   placeholder="Age"></div>
                        <label for="gender" class="col-sm-2 col-form-label">Gender:</label>
                        <div class="col">
                            <input value="<?php echo $row['gender']?>" disabled name="gender" type="text" id="gender" class="form-control"
                                   placeholder="Gender"></div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label">Address:</label>
                        <div class="col">
                            <input value="<?php echo $row['address']?>" disabled name="address" type="text" id="address" class="form-control"
                                   placeholder="Address"></div>
                        <label for="indigenousgroup" class="col-sm-2 col-form-label">Indigenous Group:</label>
                        <div class="col">
                            <input value="<?php echo $row['indigenousgroup'] ?>" name="indigenousGroup" type="text" id="indi" class="form-control" 
                                        placeholder="Indigenous Group"></div>                        
                    </div>
                    <div class="form-group row">
                        <label for="course" class="col-sm-2 col-form-label">Course:</label>
                        <div class="col">
                            <input value="<?php echo $row['course'] ?>" disabled name="course" type="text" id="course" class="form-control"
                                        placeholder="Course"></div>
                    </div>
                    <div class="form-group row">
                        <label for="contactnum" class="col-sm-2 col-form-label">Contact Number:</label>
                        <div class="col">
                            <input value="<?php echo $row['cellphone'] ?>" name="contactnum" disabled type="text" id="contactnum" class="form-control"
                                        placeholder="Contact Number"></div>
                    </div>       
                    <div class="text-center">
                        <input name="editIndigenous" type="submit" class="mr-5 btn btn-primary" value="Done">
                        <a href="indigenous.php" class="ml-5 btn btn-secondary">Go Back</a>
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
