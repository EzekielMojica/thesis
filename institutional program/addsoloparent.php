<?php
require_once "../include/cn.php";


if (!isset($_SESSION)) {
    session_start();
}
if (isset($_GET['noano'])){
    $noano = test_input($_GET['noano']);
    $sql = "SELECT tbladmission.*, tblnoa.course FROM tblnoa INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno WHERE noano = '$noano'";
    $result = $conn->query($sql);
    $row = $result->fetch_array();
}else{
    header('Location: scholarship.php');
}
if (isset($_POST['addSoloParent'])) {

    $noOfChild = test_input($_POST['noofchild']);
    $sql = "INSERT INTO tblsoloparent VALUES (null, '$noOfChild', '$noano')";
    $result = $conn->query($sql) or die(mysqli_error($conn));

    //audit add
    date_default_timezone_set('Asia/Manila');
    $user=$_SESSION["username"];
    $action = "Added a record in solo parent.";
    $dateandtime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
    $conn->query($sql) or die(mysqli_error($conn));
    echo "<script>alert('Solo Parent record successfully added!');
        window.location='soloparent.php';
        </script>";
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
                Add Solo Parent
            </div>
            <div class="card-body">
                <form method="post">
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
                        <label for="noofchild" class="col-sm-2 col-form-label">Number of Child:</label>
                        <div class="col">
                            <input pattern="\d{1,2}" name="noofchild" type="text" id="noofchild" class="form-control"
                                        placeholder="Number of Child"></div>                        
                    </div>
                    <div class="form-group row">
                        <label for="course" class="col-sm-2 col-form-label">Course:</label>
                        <div class="col">
                            <input value="<?php echo $row['course']?>" disabled name="course" type="text" id="course" class="form-control"
                                        placeholder="Course"></div>
                    </div>
                    <div class="form-group row">
                        <label for="contactnum" class="col-sm-2 col-form-label">Contact Number:</label>
                        <div class="col">
                            <input value="<?php echo $row['cellphone']?>" disabled name="contactnum" type="text" id="contactnum" class="form-control"
                                        placeholder="Contact Number"></div>
                    </div>  
                    <div class="text-center">
                        <input name="addSoloParent" type="submit" class="mr-5 btn btn-primary" value="Add">
                        <a href="soloparent.php" class="ml-5 btn btn-secondary">Go Back</a>
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
