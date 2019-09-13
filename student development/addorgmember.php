<?php
require_once "../include/cn.php";


if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_GET['orgid'])) {
    header("Location: studentorg");
} else {

    $orgid = $_GET['orgid'];
    if (isset($_GET['noano'])) {
        $noano = test_input($_GET['noano']);
        $sql = "SELECT tblnoa.course, tbladmission.name, tbladmission.address, tbladmission.telephone, tbladmission.cellphone, tbladmission.email  FROM tblnoa INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno WHERE noano = '$noano'";
        $result = $conn->query($sql);
        $row = $result->fetch_array();
    } else {
        header('Location: studentorgs.php');
    }
    if (isset($_POST['addOrgMember'])) {
        $position = test_input($_POST['position']);
        $sql = "INSERT INTO tblorgmember (position, orgid, noano)
             VALUES ('$position', '$orgid', '$noano')";
        $result = $conn->query($sql) or die(mysqli_error($conn));

        //audit add
        date_default_timezone_set('Asia/Manila');
        $user = $_SESSION["username"];
        $action = "Added an organization member.";
        $dateandtime = date("Y-m-d H:i:s");
        $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
        $conn->query($sql) or die(mysqli_error($conn));

        header('Location: orgmember.php?orgid=' . $orgid . '');
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
                <span class="fas fa-user-plus"></span>
                Add New Member
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group row form-inline">
                        <label for="name" class="form-label col-md-2">Full Name:</label>
                        <input name="name" required type="text" id="name" class="col-md-5 form-control"
                               value="<?php echo $row['name'] ?>" disabled placeholder="Full Name">
                        <label for="course" class="form-label col-md-2">Course: </label>
                        <input name="course" value="<?php echo $row['course'] ?>" disabled required type="text" id="course" class="form-control"
                               placeholder="Course">
                    </div>
                    <div class="form-group row form-inline">
                        <label for="position" class="form-label col-md-2">Position: </label>
                        <input name="position" required type="text" id="position" class="form-control"
                               placeholder="Position">
                        <label for="address" class="form-label col-md-2">Address: </label>
                        <input name="address" value="<?php echo $row['address'] ?>" disabled required type="text" id="address" class="col-md-5 form-control"
                               placeholder="Address">

                    </div>
                    <div class="form-group row form-inline">
                        <label for="contactno" class="form-label col-md-2">Contact No.: </label>
                        <div class="col">
                            <input name="contactno" required type="text" id="contactno" class="form-control"
                                   value="<?php echo $row['cellphone'] ?>" disabled placeholder="Contact No.">
                        </div>
                    </div>
                    <div class="text-center">
                        <input name="addOrgMember" type="submit" class="mr-5 btn btn-primary" value="Add">
                        <a href="orgmember.php?orgid=<?php echo $orgid ?>" class="ml-5 btn btn-secondary">Go Back</a>
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
