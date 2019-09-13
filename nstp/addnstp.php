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
    header('Location: foreignstudent.php');
}
if (isset($_POST['addNSTP'])) {

    $serialno = test_input($_POST['serialno']);
    $category = test_input($_POST['category']);
    $paddress = test_input($_POST['paddress']);
    $sql = "INSERT INTO tblnstpenrollees  VALUES (null, '$serialno', '$category', '$paddress', '$noano')";
    $result = $conn->query($sql);

    //audit add
    date_default_timezone_set('Asia/Manila');
    $user=$_SESSION["username"];
    $action = "Added a student record in NSTP.";
    $dateandtime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
    $conn->query($sql) or die(mysqli_error($conn));

    echo "<script>alert('NSTP student record successfully added!');window.location.href='nstpenrollees.php'
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
                Add NSTP Enrollees
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group row">
                        <label for="serialno" class="col-sm-2 col-form-label">Serial Number:</label>
                        <div class="col">
                            <input name="serialno" type="text" id="serialno" class="form-control"
                                   placeholder="Serial Number"></div>
                        <label for="category" class="col-sm-2 col-form-label">Category:</label>
                        <div class="col">
                            <select class="form-control" name="category" id="category" required>
                                <option value="">SELECT PROGRAM COMPONENT</option>
                                <optgroup label="PROGRAM COMPONENTS">
                                    <option value="CWTS">Civic Welfare Training Service (CWTS)</option>
                                    <option value="LTS">Literacy Training Service (LTS)</option>
                                </optgroup>
                            </select></div>
                    </div>
                    <div class="form-group row" id="name">
                        <label for="name" class="col-sm-2 col-form-label">Name:</label>
                        <div class="col" id="firstName">
                            <input required name="name" value="<?php echo $row['name']?>" disabled type="text" class="form-control" id="fn"
                                   placeholder="First Name"></div>
                    </div>
                    <div class="form-group row">
                        <label for="cys" class="col-sm-2 col-form-label">Course/Program:</label>
                        <div class="col">
                            <input value="<?php echo $row['course']?>" disabled required name="cys" type="text" id="cys" class="form-control"
                                   placeholder="Course/Program"></div>
                    </div>
                    <div class="form-group row">
                        <label for="gender" class="col-sm-2 col-form-label">Gender:</label>
                        <div class="col">
                            <input value="<?php echo $row['gender']?>" disabled required name="gender" type="text" id="gender" class="form-control"
                                   placeholder="Gender"></div>
                        <label for="birthdate" class="col-sm-2 col-form-label">Birthdate:</label>
                        <div class="col">
                            <input value="<?php echo $row['dateofbirth']?>" disabled required name="birthdate" type="text" id="birthdate" class="form-control"
                                   placeholder="Birthdate"></div>
                    </div>
                    <div class="form-group row">
                        <label for="paddress" class="col-sm-2 col-form-label">Provincial Address:</label>
                        <div class="col">
                            <input required name="paddress" type="text" id="paddress" class="form-control"
                                   placeholder="Provincial Address"></div>
                    </div>
                    <div class="form-group row">
                        <label for="contactno" class="col-sm-2 col-form-label">Contact Number:</label>
                        <div class="col">
                            <input  value="<?php echo $row['cellphone']?>" disabled required name="contactno" type="text" id="contactno" class="form-control"
                                   placeholder="Contact Number"></div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">E-mail:</label>
                        <div class="col">
                            <input  value="<?php echo $row['email']?>" disabled required name="email" type="text" id="email" class="form-control"
                                   placeholder="E-mail"></div>
                    </div>
                    <div class="text-center">
                        <input name="addNSTP" type="submit" class="mr-5 btn btn-primary" value="Add">
                        <a href="nstpenrollees.php" class="ml-5 btn btn-secondary">Go Back</a>
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
