<?php
require_once "../include/cn.php";

if (!isset($_SESSION)) {
    session_start();
    if (!isset($_GET['memberno'])) {
        header('Location: orgmember.php');
        exit;
    } else {
        $memberno = test_input($_GET['memberno']);
        $sql = "SELECT tbladmission.*, tblnoa.course, tblorgmember.* FROM tblorgmember INNER JOIN tblnoa ON tblorgmember.noano = tblnoa.noano INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno WHERE memberno = '$memberno'";
        $result = $conn->query($sql);
        if ($result->num_rows == 0) {
            header('Location: orgmember.php');
            exit;
        }
        $row = $result->fetch_array();
    }
}

if (isset($_POST['editOrgMember'])) {
    $position = test_input($_POST['position']);
       $sql = "UPDATE tblorgmember SET position = '$position' WHERE memberno = '$memberno'";
    $result = $conn->query($sql)or die(mysqli_error($conn));
    $orgid = $_GET['orgid'];
    //audit edit
    date_default_timezone_set('Asia/Manila');
    $user=$_SESSION["username"];
    $action = "Updated an organization members record.";
    $dateandtime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
    $conn->query($sql) or die(mysqli_error($conn));

    header('Location: orgmember.php?orgid='.$orgid.'');
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
                Edit Organization Member
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group row form-inline">
                        <label for="name" class="form-label col-md-2 ml-1">Full Name:</label>
                        <input value="<?php echo $row['name'] ?>" DISABLED name="name" required type="text" id="name"  class="col-md-5 form-control"
                               placeholder="Full Name">
                        <label for="course" class="form-label col-md-2">Course: </label>
                        <input value="<?php echo $row['course'] ?>" disabled name="course" required type="text" id="course"  class="form-control"
                               placeholder="Course">
                    </div>

                    <div class="form-group row form-inline">
                        <label for="position" class="form-label col-md-2">Position: </label>
                        <div class="col">
                            <input value="<?php echo $row['position'] ?>" name="position" required type="text" id="position"  class="form-control"
                                   placeholder="Position">
                        </div>
                        <label for="address" class="form-label col-md-2">Address: </label>
                        <div class="col">
                            <input value="<?php echo $row['address'] ?>" disabled name="address" required type="text" id="address"  class="form-control"
                                   placeholder="Address">
                        </div>

                    </div>
                    <div class="form-group row form-inline">
                        <label for="contactno" class="form-label col-md-2">Contact No.: </label>
                        <div class="col">
                            <input value="<?php echo $row['cellphone'] ?>" disabled name="contactno" required type="text" id="contactno"  class="form-control"
                                   placeholder="Contact No.">
                        </div>
                    </div>
                    <div class="text-center">
                        <input  name="editOrgMember" type="submit" class="mr-5 btn btn-primary" value="Update">
                        <a href="orgmember.php?orgid=<?php echo $_SESSION["orgid"] ?>" class="ml-5 btn btn-secondary">Go Back</a>
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
